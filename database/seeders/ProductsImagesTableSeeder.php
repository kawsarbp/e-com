<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImageReco =
            [
                ['product_id'=>1,'image'=>'727906948240322102220.png','status'=>1]
            ];

        DB::table('products_images')->insert($productImageReco);
    }
}
