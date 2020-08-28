<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Teaser;
use App\Photo;
use App\ContentMonetize;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id',  'artist', 'castandcrew', 'description', 'banner_image', 'content_link', 'format', 'client_id', 'status', 'publish', 'monetize', 'language', 'genres', 'tags', 'display_tags', 'privacy_settings', 'go_live_status', 'go_live_date', 'created_by', 'updated_by'
    ];
    protected $dates = ['deleted_at'];

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

    function client()
    {
        return  $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function channel_content()
    {
        return $this->hasOne(ChannelContent::class, 'content_id', 'id');
    }

    // public function payments()
    // {
    //     return $this->hasMany(Payment::class)->where(['item_type' => 'Content::class', 'content_id' => 'id']);
    // }
}
