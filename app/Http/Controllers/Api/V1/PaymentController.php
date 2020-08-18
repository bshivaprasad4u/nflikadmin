<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Payment;

use Razorpay\Api\Api;

class PaymentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
    }


    public function payment_initiation()
    {
        $order  = $this->api->order->create(array('receipt' => request()->item_id, 'amount' => request()->amount, 'currency' => request()->currency)); // Creates order
        $payment_initiation_data = [
            'order_id' => $order->id,
            'item_id' => request()->item_id,
            'item_type' => request()->item_type,
            'amount' => request()->amount,
            'currency' => request()->currency,
            'user_id' => auth('api')->user()->id,
            'payment_status' => 'initiated'
        ];
        $payment = Payment::create($payment_initiation_data);
        if ($order && $payment) {
            return $this->respond($order);
        } else {
            return $this->respondWithMessage("Oops something went wrong. Payment Not initiated.");
        }
        //dd($order);
    }

    public function payment_response()
    {
        //$payment = $this->api->payment->fetch(request()->razorpay_payment_id);
        $update_payment = Payment::findOrfail(request()->order_id);
        $update_payment->request()->razorpay_order_id;
        $update_payment->request()->razorpay_payment_id;
        $update_payment->request()->razorpay_signature;
        $update_payment->save();
        $this->validate_signature_update_status($update_payment);
    }

    public function update_payment_status(Payment $update_payment)
    {
        $order_id = $update_payment->order_id;
        $razorpay_payment_id = $update_payment->payment_id;
        $payment_status = $this->validate_signature($order_id, $razorpay_payment_id);
    }

    public function validate_signature_update_status(Payment $update_payment)
    {
        $attrbutes  = array('razorpay_signature'  => $update_payment->razorpay_signature,  'razorpay_payment_id'  => $update_payment->razorpay_payment_id,  'razorpay_order_id' => $update_payment->razorpay_order_id);
        if ($this->api->utility->verifyPaymentSignature($attrbutes)) {
            $update_payment->payment_status = 'success';
            $update_payment->save();
            return $this->respondWithMessage("Payment successful.");
        } else {
            $update_payment->payment_status = 'failed';
            $update_payment->save();
            return $this->respondWithMessage("Payment successful.");
        }
    }
}
