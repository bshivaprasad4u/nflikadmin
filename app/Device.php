<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $fillable = [
        'device_id', 'device_name', 'browser', 'platform', 'user_id', 'user_token', 'verification_code'
    ];
    public function generate_verification_code()
    {
        $this->attributes['verification_code'] = rand(100000, 999999);;
        $this->save();
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
