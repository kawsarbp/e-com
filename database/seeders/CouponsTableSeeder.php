<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponRecords = [
            [
                'coupon_option'=>'manual',
                'coupon_code'=>'test10',
                'categories'=>'1,2',
                'users'=>'kawsarfaz100@gmail.com,kawsarahmed1512@gmail.com',
                'coupon_type'=>'single',
                'amount_type'=>'percentage',
                'amount'=>'10',
                'expire_date'=>'2022-12-31',
                'status'=>1,
            ]
        ];

        DB::table('coupons')->insert($couponRecords);
    }
}
