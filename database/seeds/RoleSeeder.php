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
                'description' => 'Quản trị hệ thống',
            ],
            [
                'name' => 'dev',
                'description' => 'Phát triển hệ Thống',
            ],
            [
                'name' => 'content',
                'description' => 'Quản lý nội dung',
            ],
            [
                'name' => 'editor',
                'description' => 'Chỉnh sửa nội dung',
            ],
        ];
        Role::insert($data);
    }
}
