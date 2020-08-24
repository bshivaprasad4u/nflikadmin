<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChannelContent extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'channel_id', 'content_id', 'number_of_slots', 'created_by', 'updated_by'
    ];
    protected $dates = ['deleted_at'];
    public function channel_content()
    {
        return $this->hasMany(Content::class);
    }
}
