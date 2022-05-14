<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $DeliveryRecoards = [
            'user_id'=>1,
            'name'=>'kawsar ahmed',
            'address'=>'pabna',
            'city'=>'pabna sader',
            'state'=>'pabna',
            'country'=>'bangladesh',
            'pincode'=>'123123',
            'mobile'=>01746755225,
            'status'=>1,
        ];

        DB::table('delivery_addresses')->insert($DeliveryRecoards);
    }
}
