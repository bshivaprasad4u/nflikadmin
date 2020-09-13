<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'item_id', 'item_type', 'amount', 'currency', 'user_id', 'payment_status', 'razorpay_payment_id', 'razorpay_order_id', 'razorpay_signature'
    ];

    public function setItemTypeAttribute($value)
    {
        if ($value == 'movie')
            $this->attributes['item_type'] = 'Content::class';
        elseif ($value == 'subscription')
            $this->attributes['item_type'] = 'SubscriptionUser::class';
        elseif ($value == 'coupon')
            $this->attributes['item_type'] = 'CouponsUser::class';
        elseif ($value == 'event')
            $this->attributes['item_type'] = 'EventsUser::class';
    }

    // public function contents()
    // {
    //     return $this->hasMany(Content::class)->where('item_type', 'Content::class');
    // }
}
