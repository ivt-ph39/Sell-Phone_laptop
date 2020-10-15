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
    public function run(Role $role)
    {
        $data = [
            [
                'name' => 'guest',
                'description' => 'Nguoi dung'
            ],
            [
                'name' => 'admin',
                'description' => 'Quan li'
            ]
        ];
        $role->insert($data);
    }
}