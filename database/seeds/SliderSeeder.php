<?php

use App\Model\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Slider $slider)
    {
        $data = [
            [
                'name' => 'samsung-galaxy-note-20',
                'path' => 'https://cdn.tgdd.vn/2020/09/banner/Normal-Note20-800-300-800x300.png',
                'active' => 1
            ], [
                'name' => 'vivo-v20',
                'path' => 'https://cdn.tgdd.vn/2020/10/banner/800-300-800x300-1.png',
                'active' => 1

            ], [
                'name' => 'phu-kien-hotsale',
                'path' => 'https://cdn.tgdd.vn/2020/10/banner/big-pk-800-300-800x300.png',
                'active' => 1

            ], [
                'name' => 'apple-iphone',
                'path' => 'https://cdn.tgdd.vn/2020/10/banner/800-300-800x300-2.png',
                'active' => 1

            ], [
                'name' => 'dong-ho-gia-soc',
                'path' => 'https://cdn.tgdd.vn/2020/09/banner/reno4-chung-800-300-800x300-1.png',
                'active' => 1

            ],  [
                'name' => 'dong-ho-thong-minh-samsung-galaxy-watch-3',
                'path' => 'https://cdn.tgdd.vn/2020/10/banner/800-300-800x300-1.png',
                'active' => 1

            ]
        ];
        $slider->insert($data);
    }
}