<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriptionUser extends Model
{
    protected $fillable = [
        'user_id', 'subscription_id', 'expires_at'
    ];

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function subscription_user()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }
}
