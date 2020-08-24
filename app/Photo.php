<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Content;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'link', 'status', 'content_id', 'created_by', 'updated_by'
    ];
    protected $dates = ['deleted_at'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
