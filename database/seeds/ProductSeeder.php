<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
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
                'p_name'        => 'Điện thoại OPPO Reno333333',
                'p_number'      => 50,
                'p_active'      => 1,
                'p_price'       => 7490000,
                'p_sale'        => 30,
                'p_hot'         => 1,
                'p_view'        => 500,
                'p_category_id' => 4,
                'p_avatar'      => 'uploads/images/product/phone/oppo-reno3-trang-400x460-400x460.png',
                'p_title'       => 'Điện thoại OPPO Reno3',
                'p_keyword_seo' => 'OPPO Reno3, dien thoai oppo reno3',
                'p_promotion'   => 'Phụ kiện mua kèm giảm 20% (không áp dụng phụ kiện hãng, không áp dụng đồng thời KM khác).Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác) (click xem chi tiết)',
                'p_technical' => 
                '[
                    {
                    "name":"Màn hình",
                    "value": "AMOLED, 6.4\", Full HD+"
                    },
                    {
                    "name":"Hệ điều hành",
                    "value": "2121"
                    }
                ]',
                'p_detail'      => 'OPPO Reno3 là một sản phẩm ở phân khúc tầm trung nhưng vẫn sở hữu cho mình ngoại hình bắt mắt, cụm camera chất lượng và cùng nhiều đột phá về màn hình cũng như hiệu năng.',
                'p_created_by'  => 3,
                'p_update_by'   => 1
            ]

        ];
        DB::table('products')->insert($data);
    }
}