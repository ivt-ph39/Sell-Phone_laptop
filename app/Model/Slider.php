<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Slider extends Model
{
    protected $table = "sliders";
    protected $fillable = ['name', 'path', 'active'];
    protected $active = [
        1 => [
            'name' => 'public',
            'class' => 'badge-success'
        ],
        0 => [
            'name' => 'private',
            'class' => 'badge-secondary'
        ]
    ];
    public function setActiveAttribute($value)
    {
        $this->attributes['active'] = ($value != null) ? 1 : 0;
    }
    public function getActiveAttribute($value)
    {
        return Arr::get($this->active, $value);
    }
    public function getNameAttribute($value)
    {
        return [
            "base" => $value,
            "slug" => Str::slug($value)
        ];
    }
}