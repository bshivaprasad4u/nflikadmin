<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsSubscriptions extends Model
{
    protected $fillable = [
        'client_id', 'subscription_id',
    ];

    function client()
    {
        return $this->hasOne(Client::class)->whereNull('parent_id');
    }
    function clientsubscription()
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }
}
