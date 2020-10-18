<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = ['user_id', 'product_id', 'content', 'star'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}