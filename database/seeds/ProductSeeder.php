<?php

use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Product $product)
    {
        $textDescription = '<p>OPPO Reno3 l&agrave; một sản phẩm ở ph&acirc;n kh&uacute;c tầm trung nhưng vẫn sở hữu cho m&igrave;nh ngoại h&igrave;nh bắt mắt, cụm camera chất lượng v&agrave; c&ugrave;ng nhiều đột ph&aacute; về m&agrave;n h&igrave;nh cũng như hiệu năng.</p>

<p><img alt="" src="http://127.0.0.1:8000/storage/uploads/oppo-a92-tgdd-7_1604657000.jpg" style="height:344px; width:620px" /></p>

<p>Dung lượng RAM 8 GB v&agrave; 128 GB bộ nhớ trong qu&aacute; đủ để người d&ugrave;ng thoải m&aacute;i lưu trữ dữ liệu, tải c&aacute;c ứng dụng nặng về m&aacute;y sử dụng.</p>

<p><img alt="" src="http://127.0.0.1:8000/storage/uploads/oppo-a92-tgdd-84_1604657084.jpg" style="height:413px; width:620px" /></p>

<p>M&aacute;y được c&agrave;i đặt sẵn hệ điều h&agrave;nh Android 10 tr&ecirc;n giao diện Color OS 7.1 kh&ocirc;ng chỉ mang đến giao diện người d&ugrave;ng tối giản v&agrave; c&aacute;c biểu tượng mới, m&agrave; c&ograve;n một số t&iacute;nh năng nổi bật n&acirc;ng cao trải nghiệm người d&ugrave;ng.</p>';

        for ($i = 0; $i < 100; $i++) {
            $data =
                [
                    'name'        => 'Điện thoại' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/42/227295/oppo-a53-2020-blue-600x600-400x400.jpg',
                    'title'       => 'Điện thoại' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 1,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 40; $i++) {
            $data =
                [
                    'name'        => 'Laptop' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/44/218439/hp-348-g7-i5-9ph06pa-kg2-1-218439-400x400.jpg',
                    'title'       => 'Laptop' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 2,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 40; $i++) {
            $data =
                [
                    'name'        => 'Tablet' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/522/220163/ipad-pro-11-inch-2020-600x600-fix-200x200.jpg',
                    'title'       => 'Tablet' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 3,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 40; $i++) {
            $data =
                [
                    'name'        => 'Đồng hồ--' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/7077/229033/apple-watch-s6-lte-40mm-vien-nhom-day-cao-su-ava-400x400.jpg',
                    'title'       => 'Đồng hồ--' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 5,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 15; $i++) {
            $data =
                [
                    'name'        => 'Chuột máy tính--' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/86/229589/chuot-khong-day-zadez-m338-ava-600x600.jpg',
                    'title'       => 'Chuột máy tính--' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 6,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 15; $i++) {
            $data =
                [
                    'name'        => 'Pin sạc dự phòng--' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/57/228892/sac-du-phong-10000mah-type-c-powerslim-jp213-600x600.jpg',
                    'title'       => 'Pin sạc dự phòng--' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 7,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 15; $i++) {
            $data =
                [
                    'name'        => 'Tai Nghe--' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/54/228488/tai-nghe-chup-tai-beats-solo3-wireless-mx432-mv8t2-ava-600x600.jpg',
                    'title'       => 'Tai Nghe--' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 8,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
        for ($i = 0; $i < 15; $i++) {
            $data =
                [
                    'name'        => 'Ổ cững di động--' . $i,
                    'quantity'    => random_int(0, 20),
                    'active'      => random_int(0, 1),
                    'price'       => Arr::random([11000000, 12000000, 13000000, 14000000, 15000000, 16000000, 17000000, 18000000, 19000000, 20000000, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000]),
                    'sale'        => Arr::random([0, 5, 10, 15, 20]),
                    'hot'         => random_int(0, 1),
                    'avatar'      => 'https://cdn.tgdd.vn/Products/Images/1902/227330/o-cung-hdd-seagate-backup-plus-slim-sthn1000400-1-1-600x600.jpg',
                    'title'       => 'Ổ cững di động--' . $i . ' Chính Hãng',
                    'promotion'   => '[{"name": "Khuyến mãi 1"},{"name": "Khuyến mãi 2"},{"name": "Khuyến mãi 3"}]',
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
                    'description' => $textDescription,
                    'category_id' => 9,
                    'brand_id'    => random_int(1, 7),
                    'created_by'  => 1
                ];
            $product->insert($data);
        }
    }
}