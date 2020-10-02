<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Contact extends Model
{
    protected $table    = 'contacts';
    protected $fillable = ['ct_name', 'ct_content', 'ct_icon', 'ct_active'];
    protected $active   = [
        1 => [
            'name'  => 'public',
            'class' => 'badge-success'
        ],
        0 => [
            'name'  => 'private',
            'class' => 'badge-secondary'
        ]
    ];

    public function setCtActiveAttribute($value)
    {
        $this->attributes['ct_active'] = ($value == 'on') ? 1 : 0;
    }
    public function getCtActiveAttribute($value)
    {
        return Arr::get($this->active, $value);
    }
}