<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {
    
    protected $fillable = ['slug', 'title', 'order'];

    public $timestamps = false;
    
    public function posts() {
        return $this->belongsToMany(Post::class);
    }
    
    public function setUpdatedAt($value) {
      return NULL;
    }
    
    public function setCreatedAt($value) {
      return NULL;
    }
}
