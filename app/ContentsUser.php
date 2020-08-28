<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentsUser extends Model
{
    protected $fillable = [
        'user_id', 'content_id'
    ];

    function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function contents_user()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }
}
