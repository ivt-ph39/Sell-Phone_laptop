<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'name' => 'guest',
                'description' => 'Khách hàng',
            ],
            [
                'name' => 'admin',
                'description' => 'Quản trị hệ thống',
            ],
            [
                'name' => 'Ql đơn hàng',
                'description' => 'Ql đơn hàng',
            ],
            [
                'name' => 'Ql bình luận',
                'description' => 'Ql bình luận',
            ],
            [
                'name' => 'Ql sản phẩm',
                'description' => 'Ql sản phẩm',
            ],
        ];
        Role::insert($data);
    }
}