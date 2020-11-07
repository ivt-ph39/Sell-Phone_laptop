<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    // use SoftDeletes;
    protected $table = 'categories';

    // protected $primaryKy = 'c_create_by';
    protected $fillable = ['id', 'name', 'icon', 'image', 'parent_id', 'active', 'create_by', 'deleted_at'];

    public function createBy()
    {
        return $this->belongsTo('App\User', 'create_by');
    }

    public function getParentIdAttribute($value)
    {
        if ($value == 0) {
            return [
                'name' => '----',
                'id'   => $value
            ];
        } else {

            return [
                'name' => $this->find($value)->name,
                'id'   => $value
            ];
        }
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function hasChild($value)
    {
        return ($this->where('parent_id', $value)->count() != 0) ? $this->where('parent_id', $value)->get() : false;
    }
}