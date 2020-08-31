<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionUser extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'subscription_id', 'expires_at'
    ];
    protected $dates = ['deleted_at', 'expires_at'];

    function subscribed_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function user_subscription_details()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }
}
