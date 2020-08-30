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
    protected $dates = ['deleted_at'];

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function subscription_user()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }
}
