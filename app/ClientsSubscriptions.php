<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsSubscriptions extends Model
{
    protected $fillable = [
        'client_id', 'subscription_id',
    ];
}
