<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(User $user)
    {
        $data = [
            [
                'name' => 'hunglt', // id 1
                'email' => 'hunglt1011@gmail.com',
                'password' => bcrypt('123456789')
            ],
            [
                'name' => 'Ngo The Quang', // id 2
                'email' => 'quangdnn98@gmail.com',
                'password' => bcrypt('123123123')
            ],
            [
                'name' => 'qlsanpham',
                'email' => 'qlsanpham@gmail.com',
                'password' => bcrypt('123456789')
            ],
            [
                'name' => 'qlbinhluan',
                'email' => 'qlbinhluan@gmail.com',
                'password' => bcrypt('123123123')
            ],
            [
                'name' => 'qldonhang',
                'email' => 'qldonhang@gmail.com',
                'password' => bcrypt('123456789')
            ],
            [
                'name'  => 'Lê Thành Hưng',
                'email' => 'lethanhhung1011@gmail.com',
                'password' => bcrypt('123456789')
            ],

        ];
        $user->insert($data);
    }
}