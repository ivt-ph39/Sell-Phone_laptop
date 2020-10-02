<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
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
                'c_name' => 'Điện Thoại',
                'c_icon' => 'fa-mobile-alt',
                'parent_id' => '0',
                'c_active' => '1',
                'c_total_product' => '50',
                'c_create_by' => '1',
            ],
            [
                'c_name' => 'Laptop',
                'c_icon' => 'fa-laptop',
                'parent_id' => '0',
                'c_active' => '1',
                'c_total_product' => '50',
                'c_create_by' => '1',
            ],
            [
                'c_name' => 'Tablet',
                'c_icon' => 'fa-tablet',
                'parent_id' => '0',
                'c_active' => '0',
                'c_total_product' => '100',
                'c_create_by' => '2',
            ]

        ];
        DB::table('categories')->insert($data);
    }
}