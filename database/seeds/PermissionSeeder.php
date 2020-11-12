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
                'name' => 'Module Admin Manager', //id 1
                'description' => 'Quản lý quyền và người dùng',
                'parent_id' => 0,
                'keycode' => '',
                
            ],
            [
                'name' => 'Admin Manager', // id 2
                'description' => 'Kiểm soát quyền và người dùng',
                'parent_id' => 1,
                'keycode' => 'admin_manager',
                
            ],
            [
                'name' => 'Module Category', // id 3
                'description' => 'Quản lý danh mục',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Category', // id 4
                'description' => 'Xem danh sách danh mục',
                'parent_id' => 3,
                'keycode' => 'list_category',
            ],
            [
                'name' => 'Module Product', // id 5
                'description' => 'Quản lý Sản Phẩm',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Product', // id 6
                'description' => 'Xem danh sách sản phẩm',
                'parent_id' => 5,
                'keycode' => 'list_product',
            ],
            [
                'name' => 'Module Brand', // id 7
                'description' => 'Quản lý Nhãn Hiệu ( Brand )',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Brand', // id 8
                'description' => 'Xem danh sách nhãn hiệu (brand)',
                'parent_id' => 7,
                'keycode' => 'list_brand',
            ],
            [
                'name' => 'Module Slider', // id 9
                'description' => 'Quản lý slide',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Slider', // id 10
                'description' => 'Xem danh sách slide',
                'parent_id' => 9,
                'keycode' => 'list_slider',
            ],
            [
                'name' => 'Module Contact', // id 11
                'description' => 'Quản lý danh mục',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Contact', // id 12
                'description' => 'Xem danh sách liên hệ',
                'parent_id' => 11,
                'keycode' => 'list_contact',
            ],
            [
                'name' => 'Module Order', // id 13
                'description' => 'Quản lý đơn hàng',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Order', // id 14
                'description' => 'Xem danh sách các đơn hàng',
                'parent_id' => 13,
                'keycode' => 'list_order',
            ],
            [
                'name' => 'Module Blog', // id 15
                'description' => 'Quản lý danh mục',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Blog', // id 16
                'description' => 'Xem danh sách bài viết',
                'parent_id' => 15,
                'keycode' => 'list_blog',
            ],
            [
                'name' => 'Module Comment', // id 17
                'description' => 'Quản lý Comment',
                'parent_id' => 0,
                'keycode' => '',
            ],
            [
                'name' => 'List Comment', // id 18
                'description' => 'Xem danh sách Comment',
                'parent_id' => 17,
                'keycode' => 'list_comment',
            ],

        ];

        Permission::insert($data);
    }

}
