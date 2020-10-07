<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['product_id', 'path'];

    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }
}