<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'product_tag', 'tag_id', 'product_id');
    }
}