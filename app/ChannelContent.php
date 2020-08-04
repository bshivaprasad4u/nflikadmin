<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelContent extends Model
{
    protected $fillable = [
        'channel_id', 'content_id', 'number_of_slots', 'created_by', 'updated_by'
    ];

    public function channel_content()
    {
        return $this->hasMany(Content::class);
    }
}
