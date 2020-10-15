<?php

namespace App;

use App\Model\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name', 'email', 'password', 'phone', 'address'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }


    public function checkPermissionAccess($permissionCheck){
        //take all vai tro cua 1 user
        //check tat ca quyen cua vai tro Neu nhu ton tai permission thi return true
        $roles = User::find(Auth::user()->id)->roles()->get();
        foreach($roles as $role){
            $permissionUser = $role->permissions()->get();
            if($permissionUser->contains('keycode', $permissionCheck)){
                return true;
            }
        }
        return false;
    }
}
