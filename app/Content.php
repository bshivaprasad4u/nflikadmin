<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Teaser;
use App\Photo;
use App\ContentMonetize;

class Content extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id',  'artist', 'castandcrew', 'description', 'banner_image', 'content_link', 'format', 'client_id', 'status', 'publish', 'monetize', 'language', 'genres', 'tags', 'display_tags', 'privacy', 'privacy_parameters', 'go_live_status', 'go_live_date', 'created_by', 'updated_by'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teasers()
    {
        return $this->hasMany(Teaser::class);
    }
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    public function contentmonetize()
    {
        return $this->hasOne(ContentMonetize::class);
    }
}
