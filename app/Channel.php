<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name', 'banner_image', 'channel_FBpage', 'channel_Twitterpage', 'channel_Instagrampage', 'status', 'subdomain', 'description', 'client_id'
    ];

    function client()
    {
        return  $this->hasOne(Client::class)->whereNull('parent_id');
    }
}
