<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    // protected $primaryKy = 'c_create_by';
    protected $fillable = ['id', 'c_name', 'c_icon', 'c_image', 'parent_id', 'c_active', 'c_total_product', 'c_create_by', 'c_parent', 'c_update_by,total_cate_child'];

    public function createBy()
    {
        return $this->belongsTo('App\Model\ManagerAdmin', 'c_create_by');
    }
    public function updateBy()
    {
        return $this->belongsTo('App\Model\ManagerAdmin', 'c_update_by');
    }
    public function getCParentAttribute($value)
    {
        if ($value == 0) {
            return [
                'name' => '----',
                'id'   => $value
            ];
        } else {

            return [
                'name' => $this->find($value)->c_name,
                'id'   => $value
            ];
        }
    }
}