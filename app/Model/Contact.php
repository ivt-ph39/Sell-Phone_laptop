<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Contact extends Model
{
    protected $table    = 'contacts';
    protected $fillable = ['name', 'content', 'icon', 'active'];
    protected $active   = [
        1 => [
            'name'  => 'public',
            'value' => 1,
            'class' => 'badge-success'
        ],
        0 => [
            'name'  => 'private',
            'value' => 0,
            'class' => 'badge-secondary'
        ]
    ];

    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = ($value == 'on') ? 1 : 0;
    }
    public function getActiveAttribute($value)
    {
        return Arr::get($this->active, $value);
    }
}