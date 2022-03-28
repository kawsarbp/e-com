<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords = [
            [
                'category_id' => 2,
                'section_id' => 1,
                'brand_id' => 1,
                'product_name' => 'Blue Casual T-Shirt',
                'product_code' => 'BT001',
                'product_color' => 'blue',
                'product_price' => '1500',
                'product_discount' => 10,
                'product_weight' => 200,
                'product_video' => '',
                'main_image' => '',
                'description' => 'Test Products',
                'wash_care' => '',
                'fabric' => '',
                'pattern' => '',
                'sleeve' => '',
                'fit' => '',
                'occasion' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'No',
                'status' => 1,
            ],
            [
                'category_id' => 2,
                'section_id' => 1,
                'brand_id' => 2,
                'product_name' => 'Red Casual T-Shirt',
                'product_code' => 'BT001',
                'product_color' => 'Red',
                'product_price' => '1700',
                'product_discount' => 10,
                'product_weight' => 200,
                'product_video' => '',
                'main_image' => '',
                'description' => 'Test Products',
                'wash_care' => '',
                'fabric' => '',
                'pattern' => '',
                'sleeve' => '',
                'fit' => '',
                'occasion' => '',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'is_featured' => 'No',
                'status' => 1,
            ]
        ];
        DB::table('products')->insert($productRecords);
//        Product::insert($productRecords);
    }
}
