<?php

namespace App\Model;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'slug', 'content', 'status', 'author', 'thumbnail'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function blog_tag()
    {
        return $this->hasMany(Blog_tag::class, 'blog_id');
    }
}