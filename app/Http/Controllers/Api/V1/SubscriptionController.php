<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Settings;
use App\Subscription;
use Exception;



class SubscriptionController extends ApiController
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }


    public function subscriptions()
    {
        $subscriptions = Subscription::all();
        // $subscription_plans = [];
        if ($subscriptions) {
            foreach ($subscriptions as $subscription) {
                if ($subscription['id'] != 1)
                    $subscription['plan']  = Settings::PLANS[$subscription['name']];
            }
            return $this->respond(['subscriptions' => $subscriptions]);
        } else {
            return $this->respondWithMessage("Oops something went wrong.");
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
            $attributes  = array('razorpay_signature'  => $update_payment->razorpay_signature,  'razorpay_payment_id'  => $update_payment->razorpay_payment_id,  'razorpay_order_id' => $update_payment->order_id);
            $this->api->utility->verifyPaymentSignature($attributes);
            $update_payment->payment_status = 'success';
            $update_payment->save();
            return $this->respondWithMessage("Payment successful.");
        } catch (SignatureVerificationError $e) {

            $update_payment->payment_status = 'fail';
            $update_payment->save();
            //return $this->respondWithMessage("$e->getMessage()");
            return $this->respondWithMessage("Payment failed.");
        }
    }
}
