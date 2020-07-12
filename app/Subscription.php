<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    function clients()
    {
        $this->belongsToMany(Client::class);
    }
}
