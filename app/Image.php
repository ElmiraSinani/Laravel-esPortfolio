<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['post_id', 'image', 'alt', 'title', 'caption', 'description', 'order'];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id');
    }
    
    
}
