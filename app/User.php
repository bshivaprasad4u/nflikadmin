<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
#use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\SendPasswordEmail;
use App\Notifications\DeviceVerificationEmail;
use App\Notifications\ApiPasswordReset;
use App\Settings;

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
        'name', 'email', 'password', 'mobile', 'dob', 'profile_image', 'profile_settings', 'country', 'state', 'city', 'zip', 'address', 'otp', 'otp_expires_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'otp', 'otp_expires_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
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

    public function generate_otp()
    {
        $this->timestamps = false;
        $this->attributes['otp'] = rand(100000, 999999);;
        $this->attributes['otp_expires_at'] = now()->addMinutes(ApiCode::OTP_EXIPRES_IN_MINS);
        $this->save();
    }

    public function setPasswordAttribute($val)
    {
        $this->attributes['password'] = Hash::make($val);
    }
    public function sendPasswordNotification($val)
    {
        $this->notify(new SendPasswordEmail($val));
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
        return $this->hasMany(Device::class, 'user_id', 'id');
    }

    public function user_subscription()
    {
        return $this->hasOne(SubscriptionUser::class, 'user_id', 'id')->latest();
    }
}
