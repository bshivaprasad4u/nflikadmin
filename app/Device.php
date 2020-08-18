<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'device_id', 'device_name', 'browser', 'platform', 'user_id', 'user_token', 'verification_code'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
