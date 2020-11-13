<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog_tag extends Model
{
    protected $fillable = ['blog_id', 'tag'];

    public function blog(){
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
