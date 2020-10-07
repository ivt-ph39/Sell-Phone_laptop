<?php

use App\Model\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Category $category)
    {
        $data = [
            [
                'name' => 'Điện Thoại',
                'icon' => 'fa-mobile-alt',
                'parent_id' => '0',
                'image'  => null,
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Laptop',
                'icon' => 'fa-laptop',
                'image'  => null,
                'parent_id' => '0',
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Tablet',
                'icon' => 'fa-tablet',
                'image'  => null,
                'parent_id' => '0',
                'active' => '1',
                'create_by' => '2',
            ],
            [
                'name' => 'Phụ kiện',
                'icon' => 'fa-headphones-alt',
                'image'  => null,
                'parent_id' => '0',
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Đồng hồ',
                'icon' => 'fa-laptop',
                'image'  => null,
                'parent_id' => '0',
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Chuột máy tính',
                'icon' => null,
                'image'  => 'https://cdn.tgdd.vn/Category/86/Chuot-may-tinh-l-09-12-2019.png',
                'parent_id' => '4',
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Pin sạc dự phòng',
                'icon' => null,
                'image'  => 'https://cdn.tgdd.vn/Category/57/Pin-sac-du-phong-l-21-10-2019.png',
                'parent_id' => '4',
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Tai Nghe',
                'icon' => null,
                'image'  => 'https://cdn.tgdd.vn/Category/54/Tai-nghe-l-21-10-2019.png',
                'parent_id' => '4',
                'active' => '1',
                'create_by' => '1',
            ],
            [
                'name' => 'Thẻ nhớ',
                'icon' => null,
                'image'  => 'https://cdn.tgdd.vn/Category/55/The-nho-l-21-10-2019.png',
                'parent_id' => '4',
                'active' => '1',
                'create_by' => '1',
            ]
        ];
        $category->insert($data);
    }
}