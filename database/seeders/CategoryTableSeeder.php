<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [
            [
                'parent_id' => 0,
                'section_id' => 1,
                'category_name' => 'T-Shirts',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 't-shirt',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ],
            [
                'parent_id' => 1,
                'section_id' => 1,
                'category_name' => 'Casual T-Shirts',
                'category_image' => '',
                'category_discount' => 0,
                'description' => '',
                'url' => 'casual t-shirt',
                'meta_title' => '',
                'meta_description' => '',
                'meta_keywords' => '',
                'status' => 1
            ]
        ];

        DB::table('categories')->insert($categoryRecords);
    }
}
