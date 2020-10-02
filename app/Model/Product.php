<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'p_name', 'p_number', 'p_active',
        'p_price', 'p_sale', 'p_hot', 'p_view',
        'p_category_id', 'p_avatar', 'p_title',
        'p_keyword_seo', 'p_promotion',
        'p_technical', 'p_detail', 'p_brand_id',
        'p_created_by', 'p_update_by'
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

    public function setPActiveAttribute($value)
    {
        $this->attributes['p_active'] = ($value != null) ? 1 : 0;
    }
    public function setPHotAttribute($value)
    {
        $this->attributes['p_hot'] = ($value != null) ? 1 : 0;
    }
    public function setPSaleAttribute($value)
    {
        $this->attributes['p_sale'] = ($value != null) ? $value : 0;
    }

    public function getActive($p_active)
    {
        return Arr::get($this->active, $p_active);
    }
    public function getHot($p_hot)
    {
        return Arr::get($this->hot, $p_hot);
    }
    public function formatPrice($p_price)
    {
        return number_format($p_price, 0, '.', ',') . " vnđ";
    }
    public function formatSale($p_sale)
    {
        return $p_sale . " %";
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'p_category_id');
    }
    public function images()
    {
        return $this->hasMany('App\Model\Image', 'product_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Model\Tag', 'product_tag', 'product_id', 'tag_id')->withTimestamps();
    }
}