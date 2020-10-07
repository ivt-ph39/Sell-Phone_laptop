<?php

use App\Model\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Brand $brand)
    {
        $data = [
            [
                'name' => 'iphone',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/iPhone-(Apple)42-b_16.jpg'
            ],
            [
                'name' => 'samsung',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/Samsung42-b_25.jpg'
            ], [
                'name' => 'oppo',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/OPPO42-b_27.png'
            ], [
                'name' => 'xiaomi',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/Xiaomi42-b_45.jpg'
            ], [
                'name' => 'vivo',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/Vivo42-b_50.jpg'
            ], [
                'name' => 'vsmart',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/Vsmart42-b_40.png'
            ], [
                'name' => 'nokia',
                'avatar' => 'https://cdn.tgdd.vn/Brand/1/Nokia42-b_21.jpg'
            ]
        ];
        $brand->insert($data);
    }
}