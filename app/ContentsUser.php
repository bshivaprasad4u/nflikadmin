<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentsUser extends Model
{
    protected $fillable = [
        'user_id', 'content_id'
    ];

    function purchased_by_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function user_purchased_contents()
    {
        return $this->hasMany(Content::class, 'id', 'content_id');
    }
}
