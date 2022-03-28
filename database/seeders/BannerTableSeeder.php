<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bannerRecords = [
            ['image'=>'1.png','link'=>'','title'=>'Black Jacket','alt'=>'Black Jacket','status'=>1],
            ['image'=>'2.png','link'=>'','title'=>'Half Sleeve T-Shirt','alt'=>'Half Sleeve T-Shirt','status'=>1],
            ['image'=>'3.png','link'=>'','title'=>'Full Sleeve T-Shirt','alt'=>'Full Sleeve T-Shirt','status'=>1]
        ];

        DB::table('banners')->insert($bannerRecords);
    }
}
