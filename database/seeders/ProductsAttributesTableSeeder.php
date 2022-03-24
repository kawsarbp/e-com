<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttributesRecoards = [
            [
                'product_id'=>1,
                'size'=>'Small',
                'price'=>1000,
                'stock'=>10,
                'sku'=>'BT001-S',
                'status'=>1,
            ],
            [
                'product_id'=>1,
                'size'=>'Medium',
                'price'=>1200,
                'stock'=>10,
                'sku'=>'BT002-M',
                'status'=>1,
            ],
            [
                'product_id'=>1,
                'size'=>'Large',
                'price'=>1500,
                'stock'=>15,
                'sku'=>'BT003-L',
                'status'=>1,
            ],
        ];

        DB::table('products_attributes')->insert($productAttributesRecoards);
    }
}
