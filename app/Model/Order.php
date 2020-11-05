<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'email', 'phone', 'address', 'status', 'user_id', 'note', 'finished_at'];


    protected $status = [
        0 => 'Đang xử lý',
        1 => 'Đã hoàn thành'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withTimestamps();
    }
    public function getStatusAttribute($value)
    {
        return Arr::get($this->status, $value);
    }
}