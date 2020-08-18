<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'item_id', 'item_type', 'amount', 'currency', 'user_id', 'payment_status', 'razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature'
    ];
}
