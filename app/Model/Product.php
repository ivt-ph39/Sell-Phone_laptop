<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'quantity', 'active',
        'price', 'sale', 'hot',
        'category_id', 'avatar', 'title', 'rating',
        'promotion',
        'technical', 'description', 'brand_id',
        'created_by'
    ];

    protected $active = [
        1 => [
            'name' => 'public',
            'class' => 'badge-success'
        ],
        0 => [
            'name' => 'private',
            'class' => 'badge-secondary'
        ]
    ];
    protected $hot = [
        1 => [
            'name' => 'Nổi bật',
            'class' => 'badge-danger'
        ],
        0 => [
            'name' => 'Bình Thường',
            'class' => 'badge-secondary'
        ]
    ];

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = ($value != null) ? 1 : 0;
    }
    public function setHotAttribute($value)
    {
        $this->attributes['hot'] = ($value != null) ? 1 : 0;
    }
    public function setSaleAttribute($value)
    {
        $this->attributes['sale'] = ($value != null) ? $value : 0;
    }

    public function getActiveAttribute($active)
    {
        return Arr::get($this->active, $active);
    }
    public function getHotAttribute($value)
    {
        return Arr::get($this->hot, $value);
    }
    public function getPriceAttribute($value)
    {
        return [
            "format" => number_format($value, 0, '.', ',') . '<sup class ="text text-danger">đ</sup>',
            "base" => $value
        ];
    }
    public function getSaleAttribute($value)
    {
        return [
            "format" => $value . '%',
            "base"   => $value
        ];
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'category_id');
    }
    public function images()
    {
        return $this->hasMany('App\Model\Image', 'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'product_tag', 'product_id', 'tag_id')->withTimestamps();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'product_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_product', 'order_id', 'product_id');
    }
    public function getRatingAttribute()
    {
        return round($this->ratings()->avg('star'), 1);
    }
}