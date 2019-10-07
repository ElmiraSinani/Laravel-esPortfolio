<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'sourcePreviewLink', 'showSourcePreviewLink', 'livePreviewLink', 'showLivePreviewLink', 'order'];

    public function images() {
        return $this->hasMany(Image::class, 'post_id');
    }
    
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
    
 
}
