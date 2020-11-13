<?php

use App\Model\PermissionRole;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'role_id' => 2,
            'permission_id' => 2
        ];
        PermissionRole::create($data);
    }
}
