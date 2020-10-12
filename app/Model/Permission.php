<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description', 'parent_id', 'keycode'];

    public function permissionChildren(){
       return $this->hasMany('App\Model\Permission', 'parent_id', 'id');
    }
}
