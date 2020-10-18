<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $fillable = ['role_id', 'permission_id'];
    protected $table = 'permission_role';
}
