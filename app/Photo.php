<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Content;

class Photo extends Model
{
    protected $fillable = [
        'name', 'description', 'link', 'status', 'content_id'
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
