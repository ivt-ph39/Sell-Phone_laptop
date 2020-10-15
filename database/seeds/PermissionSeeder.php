<?php

use App\Model\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $data = [
            [
                'name' => 'Module User',
                'description' => 'Module người dùng đăng ký tài khoản',
                'parent_id' => 0,
                'keycode' => '',
                
            ],
            [
                'name' => 'Xem danh sách người dùng',
                'description' => 'Danh sách người dùng',
                'parent_id' => 1,
                'keycode' => 'list_user',
                
            ],
            [
                'name' => 'Thêm người dùng',
                'description' => 'Thêm người dùng',
                'parent_id' => 1,
                'keycode' => 'create_user',
                
            ],
            [
                'name' => 'Sửa người dùng',
                'description' => 'Sửa người dùng',
                'parent_id' => 1,
                'keycode' => 'edit_user',
                
            ],
            [
                'name' => 'Xóa người dùng',
                'description' => 'Xóa người dùng',
                'parent_id' => 1,
                'keycode' => 'delete_user',
                
            ],
            [
                'name' => 'Module login hệ thống',
                'description' => 'Login',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'Login admin',
                'description' => 'Login admin',
                'parent_id' => 6,
                'keycode' => 'login_admin',
            ],
            [
                'name' => 'Login user',
                'description' => 'Login user',
                'parent_id' => 6,
                'keycode' => 'login_user',
            ],
        ];

        Permission::insert($data);
    }

}
