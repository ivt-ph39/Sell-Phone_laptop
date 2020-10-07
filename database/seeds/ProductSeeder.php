<?php

use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Product $product, Category $category, Brand $brand)
    {
        for ($i = 0; $i < 50; $i++) {
            $data =
                [
                    'name'        => 'Điện thoại OPPO Renoxx  ' . $i,
                    'quantity'    => 50,
                    'active'      => 1,
                    'price'       => 7490000,
                    'sale'        => 3,
                    'hot'         => 1,
                    'avatar'      => 'https://didongviet.vn/pub/media/catalog/product/i/p/iphone-11-128gb-chinh-hang_1.jpg',
                    'title'       => 'Điện thoại OPPO Reno3 Chính Hãng',
                    'promotion'   => '[{"name": "khuyen mai 1"},{"name": "khuyen maix 2"},{"name": "khuyen maix 2"}]',
                    'technical'   =>
                    '[
                        {
                        "name":"Màn hình",
                        "value": "AMOLED, 6.4inch, Full HD+"
                        },
                        {
                        "name":"Hệ điều hành",
                        "value": "Android 10"
                        },
                        {
                        "name":"Camera sau",
                        "value": "Chính 12 MP & Phụ 8 MP, 2 MP, 2 MP"
                        },
                        {
                        "name":"Camera trước",
                        "value": "16 MP"
                        },
                        {
                        "name":"CPU",
                        "value": "Snapdragon 665 8 nhân"
                        },
                        {
                        "name":"RAM",
                        "value": "6 GB"
                        },
                        {
                        "name":"Bộ nhớ trong",
                        "value": "128 GB"
                        },
                        {
                        "name":"Thẻ nhớ",
                        "value": "MicroSD, hỗ trợ tối đa 256 GB"
                        }
                    ]',
                    'description' => 'OPPO Reno3 là một sản phẩm ở phân khúc tầm trung nhưng vẫn sở hữu cho mình ngoại hình bắt mắt, cụm camera chất lượng và cùng nhiều đột phá về màn hình cũng như hiệu năng.',
                    'category_id' => random_int(1, 9),
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
    }
}