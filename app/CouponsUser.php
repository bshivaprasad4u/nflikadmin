<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CouponsUser extends Model
{

    use SoftDeletes;
    protected $fillable = ['user_id', 'content_id', 'coupon_code', 'email_to', 'expires_at', 'used_by'];
    protected $dates = ['expires_at', 'deleted_at'];

    // public function generate_coupon_code()
    // {
    //     $this->timestamps = false;
    //     $this->attributes['coupon_code'] = join('-', str_split(Str::rand(16), 4));
    //     $this->attributes['otp_expires_at'] = now()->addDays(ApiCode::COUPON_EXIPRES_IN_DAYS);
    //     $this->save();
    // }
    function purchased_by_user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    function user_purchased_content()
    {
        return $this->hasOne(Content::class, 'id', 'content_id');
    }
}
