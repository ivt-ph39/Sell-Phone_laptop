<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table    = 'order_product';
    protected $fillable = ['quantity', 'amount', 'order_id', 'product_id'];
}