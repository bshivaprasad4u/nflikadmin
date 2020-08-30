<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Payment;
use App\SubscriptionUser;
use App\ContentsUser;
use Exception;
use Razorpay\Api\Errors\SignatureVerificationError;
use Carbon\Carbon;
use App\Notifications\ContentPayment;
use App\Notifications\SubscriptionPayment;


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
            //dd($order);
            return $this->respond($payment);
        } else {
            return $this->respondWithMessage("Oops something went wrong. Payment Not initiated.");
        }
        //dd($order);
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
            if ($payment_success) {
                if ($user_payment->item_type == 'subscription') {
                    $this->addSubscriptionUser($user_payment);
                } else  if ($user_payment->item_type == 'movie') {
                    $this->addContentUser($user_payment);
                } else  if ($user_payment->item_type == 'coupon') {
                    // $this->addCouponUser($update_payment);
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
    public function addSubscriptionUser(Payment $user_payment)
    {

        $subscription_user = [
            'user_id' => $user_payment->user_id,
            'subscription_id' => $user_payment->item_id,
            'expires_at' => Carbon::now()->addYears(1),
        ];
        dd($subscription_user);
        $subscription_payment = SubscriptionUser::create($subscription_user);
        //auth('api')->user()->notify(new SubscriptionPayment($subscription_payment));
    }

    public function addContentUser(Payment $update_payment)
    {
        if ($update_payment->item_type == 'movie') {
            $content_user = [
                'user_id' => $update_payment->user_id,
                'content_id' => $update_payment->item_id,
            ];
            $content_payment = ContentsUser::create($content_user);
            // auth('api')->user()->notify(new ContentPayment($content_payment));
        }
    }

    // public function addCouponUser(Payment $update_payment)
    // {

    //     $coupon_user = [
    //         'user_id' => $update_payment->user_id,
    //         'coupon_id' => $update_payment->item_id,
    //         'expires_at' => Carbon::now()->addYears(1),
    //     ];
    //     CouponsUser::create($coupon_user);
    // }
}
