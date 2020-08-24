<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentMonetize extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'currency',  'giftcoupon_image', 'status', 'content_id',  'created_by', 'updated_by'
    ];
    protected $dates = ['deleted_at'];

    public function content()
    {
        return $this->belogsTo(Content::class)->where('monetize', 'yes');
    }
}
