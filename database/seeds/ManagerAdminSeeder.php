<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagerAdminSeeder extends Seeder
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
                'adminName' => 'hunglt',
                'email' => 'hunglt1011@gmail.com',
                'password' => bcrypt('123456789'),
            ],
            [
                'adminName' => 'le thanh hung',
                'email' => 'lethanhhung1011@gmail.com',
                'password' => bcrypt('123456789'),
            ],
            [
                'adminName' => 'hung3',
                'email' => 'hung3@gmail.com',
                'password' => bcrypt('123456789'),
            ]
        ];
        DB::table('manager_admins')->insert($data);
    }
}