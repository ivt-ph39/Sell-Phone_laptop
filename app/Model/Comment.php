<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $table = 'comments';
    protected $fillable = ['name', 'email', 'phone', 'content', 'user_id', 'product_id', 'active', 'status', 'parent_id'];

    public function getCharFirstLastName($fullName)
    {
        $nameArr = explode(' ', $fullName);
        $lastName = array_pop($nameArr);
        return ucwords($lastName[0]);
    }
    public function products()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }
    public function hasChild($value)
    {
        return ($this->where('parent_id', $value)->count() != 0) ? $this->where('parent_id', $value)->get() : false;
    }
}