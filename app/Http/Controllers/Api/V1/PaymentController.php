<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Payment;
use App\SubscriptionUser;
use App\ContentsUser;
use Exception;
use Razorpay\Api\Errors\SignatureVerificationError;
use App\Notifications\ContentPayment;
use App\Notifications\SubscriptionPayment;
use App\Notifications\CouponPayment;
use App\Client;
use App\CouponsUser;
use App\Events\UserCouponPurchasedEvent;
use App\Events\UserSubscribedEvent;
use App\Notifications\SendCouponCode;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Razorpay\Api\Api;

class PaymentController extends ApiController
{
    protected $api;
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
    }


    public function payment_initiation()
    {
        $order  = $this->api->order->create(array('receipt' => request()->item_id, 'amount' => request()->amount, 'currency' => request()->currency)); // Creates order
        //dd($order);
        $payment_initiation_data = [
            'order_id' => $order->id,
            'item_id' => request()->item_id,
            'item_type' => request()->item_type,
            'amount' => request()->amount,
            'currency' => request()->currency,
            'user_id' => auth('api')->user()->id,
            'payment_status' => 'initiated'
        ];
        //dd($payment_initiation_data);
        $payment = Payment::create($payment_initiation_data);
        if ($order && $payment) {
            return $this->respond($payment);
        } else {
            return $this->respondWithMessage("Oops something went wrong. Payment Not initiated.");
        }
    }

    public function payment_response()
    {
        //$payment = $this->api->payment->fetch(request()->razorpay_payment_id);
        try {
            $update_payment = Payment::where(['user_id' => auth('api')->user()->id, 'order_id' => request()->order_id])->firstOrfail();

            $update_payment->razorpay_order_id = request()->razorpay_order_id;
            $update_payment->razorpay_payment_id = request()->razorpay_payment_id;
            $update_payment->razorpay_signature = request()->razorpay_signature;
            $update_payment->save();
            return $this->validate_signature_update_status($update_payment);
        } catch (Exception $e) {
            return $this->respondWithError(ApiCode::DATA_NOT_FOUND, 404);
        }
    }

    // public function update_payment_status(Payment $update_payment)
    // {
    //     $order_id = $update_payment->order_id;
    //     $razorpay_payment_id = $update_payment->payment_id;
    //     $payment_status = $this->validate_signature($order_id, $razorpay_payment_id);
    // }

    public function validate_signature_update_status(Payment $update_payment)
    {
        //dd($attrbutes);
        //dd($this->api->utility->verifyPaymentSignature($attrbutes));
        try {
            $user_payment = $update_payment;
            $attributes  = array('razorpay_signature'  => $update_payment->razorpay_signature,  'razorpay_payment_id'  => $update_payment->razorpay_payment_id,  'razorpay_order_id' => $update_payment->order_id);
            $this->api->utility->verifyPaymentSignature($attributes);
            $update_payment->payment_status = 'success';
            $payment_success = $update_payment->save();
            //  dd($payment_success);
            if ($payment_success) {
                if ($update_payment->item_type == 'SubscriptionUser::class') {
                    $this->addSubscriptionUser($update_payment);
                    //event(new UserSubscribedEvent($update_payment));
                } else  if ($update_payment->item_type == 'Content::class') {
                    $this->addContentUser($update_payment);
                } else  if ($user_payment->item_type == 'CouponsUser::class') {
                    $this->addCouponUser($update_payment, request()->email_id);
                    //event(new UserCouponPurchasedEvent($update_payment, auth()->user(), request()->email_id));
                }
            }
            return $this->respondWithMessage("Payment successful.");
        } catch (SignatureVerificationError $e) {

            $update_payment->payment_status = 'fail';
            $update_payment->save();
            //return $this->respondWithMessage("$e->getMessage()");
            return $this->respondWithMessage("Payment failed.");
        }
    }
    // public function addSubscriptionUserEvent()
    // {
    //     $update_payment = Payment::where(['user_id' => auth('api')->user()->id, 'order_id' => request()->order_id])->firstOrfail();
    //     //dd($update_payment);

    //     event(new UserCouponPurchasedEvent($update_payment, auth()->user(), request()->email_id));
    // }
    public function addSubscriptionUser(Payment $update_payment)
    {
        $subscription_user = [
            'user_id' => $update_payment->user_id,
            'subscription_id' => $update_payment->item_id,
            'expires_at' => now()->addYear(),
            'client_id' => $this->get_client_id()
        ];
        //dd($subscription_user);
        $subscription_payment = SubscriptionUser::create($subscription_user);
        if ($subscription_payment) {
            auth('api')->user()->notify(new SubscriptionPayment($subscription_payment));
        }
    }

    public function get_client_id()
    {
        // $sub = ContentsUser::where(['user_id' => auth('api')->user()->id])->first();
        $user = auth('api')->user();
        $client = Client::where(['email' => $user->email, 'phone' => $user->mobile])->first();
        if ($client) {
            $client_id = $client->id;
        } else {
            $password = Str::random(8);
            $save_data = ['name' => $user->name, 'email' => $user->email, 'phone' => $user->mobile, 'password' => Hash::make($password)];
            $insert_client = Client::create($save_data);
            $insert_client->sendClientPasswordNotification($password);
            $client_id = $insert_client->id;
        }
        return $client_id;
    }

    public function addContentUser(Payment $update_payment)
    {
        $content_user = [
            'user_id' => $update_payment->user_id,
            'content_id' => $update_payment->item_id,
        ];
        $content_payment = ContentsUser::create($content_user);
        auth('api')->user()->notify(new ContentPayment($content_payment));
    }

    public function addCouponUser(Payment $update_payment)
    {

        $coupon_user = [
            'user_id' => $update_payment->user_id,
            'content_id' => $update_payment->item_id,
            'coupon_code' => $this->get_coupon_code(),
            'expires_at' => now()->addDays(ApiCode::COUPON_EXIPRES_IN_DAYS),
            'email_to' => request()->email_id
        ];
        $coupon_payment = CouponsUser::create($coupon_user);
        if ($coupon_payment) {
            auth('api')->user()->notify(new CouponPayment($coupon_payment, request()->email_id));
            Notification::route('mail', request()->email_id)->notify(new SendCouponCode($coupon_payment));
        }
    }

    public function generate_coupon_code()
    {
        $code = join('-', str_split(Str::rand(16), 4));
        return $code;
    }

    public function get_coupon_code()
    {
        $code = $this->generate_coupon_code();
        if (CouponsUser::where('coupon_code', $code)->exists())
            $this->generate_coupon_code();
        return Str::upper($code);
    }

    public function resend_coupon_code()
    {
        $coupon_payment = CouponsUser::find(request()->id);
        if ($coupon_payment) {
            Notification::route('mail', $coupon_payment->email_to)->notify(new SendCouponCode($coupon_payment));
            return $this->respondWithMessage("Coupon Code Sent.");
        } else {
            return $this->respondWithMessage("Data not found.");
        }
    }

    public function redeem_coupon_code()
    {
        $coupon = CouponsUser::where(['coupon_code' => request()->coupon_code])->first();
        if ($coupon) {
            if ($coupon->used_by == null && $coupon->expires_at->gt(now())) {
                $coupon->used_by = auth('api')->user()->id;
                //$coupon->coupon_code = null;
                $coupon->deleted_at = now();
                $redeem = $coupon->save();
                if ($redeem) {
                    $content_user = [
                        'user_id' => $coupon->used_by,
                        'content_id' => $coupon->content_id,
                        'coupon_redeem' => 'yes'
                    ];
                    ContentsUser::create($content_user);
                    return $this->respondWithMessage("Coupon redeemed.");
                }
            } else {
                return $this->respondWithMessage("Coupon was redeemed or expired.");
            }
        } else {
            return $this->respondWithMessage("Data not found.");
        }
    }
}
