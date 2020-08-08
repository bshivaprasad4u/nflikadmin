<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'device_name', 'browser', 'platform', 'user_id', 'verification_code'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
