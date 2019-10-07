<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    
    protected $fillable = ['slug', 'title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
