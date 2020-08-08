<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ClientPasswordReset;
use App\Notifications\ClientVerifyEmail;

class Client extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'subscription_id', 'phone', 'parent_id'
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
    function subscription()
    {
        return  $this->belongsTo(Subscription::class);
    }

    function client_subscription()
    {
        return $this->hasOne(ClientsSubscriptions::class, 'client_id');
    }
    function agents()
    {
        return $this->hasMany(Client::class, 'parent_id');
    }

    function client_contents()
    {
        return $this->hasMany(Content::class, 'client_id');
    }

    function channel()
    {
        return $this->hasOne(Channel::class, 'client_id');
    }



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientPasswordReset($token));
    }
}
