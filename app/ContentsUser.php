<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentsUser extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id', 'content_id'
    ];
    protected $dates = ['deleted_at'];
    function purchased_by_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function user_purchased_content()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }
    function user_purchased_contents()
    {
        return $this->hasMany(Content::class, 'id', 'content_id');
    }
}
