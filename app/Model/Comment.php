<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'parent_id', 'product_id', 'content', 'status'];

    public function products(){
        return $this->belongsTo('App\Model\Product', 'product_id');
    }
}
