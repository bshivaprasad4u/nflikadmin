<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Device;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DeviceVerificationEmail;
use Illuminate\Support\Facades\Notification;
use Razorpay\Api\Api;

class PaymentController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function payment_initiation()
    {

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $order  = $api->order->create(array('receipt' => '123', 'amount' => request()->amount, 'currency' => request()->currency)); // Creates order
        dd($order);
    }
}
