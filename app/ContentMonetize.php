<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentMonetize extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price', 'currency',  'giftcoupon_image', 'status', 'content_id',  'created_by', 'updated_by'
    ];

    public function content()
    {
        return $this->belogsTo(Content::class)->where('monetize', 'yes');
    }
}
