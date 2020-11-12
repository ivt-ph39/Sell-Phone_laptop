<?php

use App\Model\Contact;
use Illuminate\Database\Seeder;
use PhpParser\Node\Expr\AssignOp\Concat;

class ContactSeeder extends Seeder
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
                'name' => 'phone',
                'content' => '0372218497',
                'icon' => 'fas fa-phone-alt',
                'active' => 1,
            ],
            [
                'name' => 'email',
                'content' => 'hunglt1011@gmail.com',
                'icon' => 'far fa-envelope',
                'active' => 1,
            ],
            [
                'name' => 'address',
                'content' => '149 Dũng Sĩ Thanh Khê',
                'icon' => 'fas fa-map-marker-alt',
                'active' => 1,
            ]
        ];
        Contact::insert($data);
    }
}