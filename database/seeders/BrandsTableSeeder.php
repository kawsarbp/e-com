<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandsRecords = [
            ['name'=>'Arrow','status'=>1],
            ['name'=>'Gap','status'=>1],
            ['name'=>'Lee','status'=>1],
            ['name'=>'Monte','status'=>1],
            ['name'=>'Peter England','status'=>1],
        ];

        Brand::insert($brandsRecords);
    }
}
