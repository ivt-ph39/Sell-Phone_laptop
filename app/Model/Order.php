<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'email', 'phone', 'address', 'status', 'user_id', 'note', 'finished_at'];

    // 0 dang xu li 1 đã xử lí 2 đang giao 3 hoan thanh
    // protected $status = [
    //     0 => 'Đang xử lý',
    //     1 => 'Đã xử lý',
    //     2 => 'Đang giao',
    //     3 => 'Hoàn thành'
    // ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id')->withTimestamps();
    }
    // public function getStatusAttribute($value)
    // {
    //     return Arr::get($this->status, $value);
    // }
}