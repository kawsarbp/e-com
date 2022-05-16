<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ordersStatusRecords = [
            [ 'name'=>'New','status'=>1 ],
            [ 'name'=>'Pending','status'=>1 ],
            [ 'name'=>'Hold','status'=>1 ],
            [ 'name'=>'Cancelled','status'=>1 ],
            [ 'name'=>'In Process','status'=>1 ],
            [ 'name'=>'Paid','status'=>1 ],
            [ 'name'=>'Shipped','status'=>1 ],
            [ 'name'=>'Delivered','status'=>1 ],
        ];
        DB::table('order_statuses')->insert($ordersStatusRecords);
    }
}
