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
                'name' => 'admin',
                'display_name' => 'Quản trị hệ thống',
            ],
            [
                'name' => 'guest',
                'display_name' => 'Khách Hàng',
            ],
            [
                'name' => 'dev',
                'display_name' => 'Phát triển hệ Thống',
            ],
            [
                'name' => 'content',
                'display_name' => 'Quản lý nội dung',
            ],
        ];
        Role::insert($data);
    }
}
