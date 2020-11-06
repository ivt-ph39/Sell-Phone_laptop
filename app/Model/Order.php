<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'email', 'phone', 'address', 'status', 'user_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withTimestamps();
    }
}