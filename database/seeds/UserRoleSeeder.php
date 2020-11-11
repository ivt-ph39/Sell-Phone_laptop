<?php

use App\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)->roles()->attach(2);
        User::find(2)->roles()->attach(2);
        User::find(3)->roles()->attach(5);
        User::find(4)->roles()->attach(4);
        User::find(5)->roles()->attach(3);
        User::find(6)->roles()->attach(1);
    }
}