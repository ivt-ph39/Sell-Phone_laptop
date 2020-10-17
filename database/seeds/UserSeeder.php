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
                'name' => 'hunglt',
                'email' => 'hunglt1011@gmail.com',
                'password' => bcrypt('123456789')
            ],
            [
                'name' => 'Ngo The Quang',
                'email' => 'quangdnn98@gmail.com',
                'password' => bcrypt('123123123')
            ]
        ];
        $user->insert($data);
    }
}
