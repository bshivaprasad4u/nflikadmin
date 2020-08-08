<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
#use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\DeviceVerificationEmail;
use App\Notifications\ApiPasswordReset;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $guard = 'api';
    protected $with = ['devices'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile', 'dob', 'profile_image', 'profile_settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ApiPasswordReset($token));
    }
    public function sendDeviceVerificationCode($token)
    {
        $this->notify(new DeviceVerificationEmail($token));
    }

    public function devices()
    {
        return $this->hasOne(Device::class)->whereNull('verification_code');
    }
}
