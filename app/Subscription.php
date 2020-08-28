<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status',
    ];
    protected $dates = ['deleted_at'];
    function clients()
    {
        $this->belongsToMany(Client::class)->whereNull('parent_id');
    }
}
