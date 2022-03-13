<?php

namespace Database\Seeders;

use App\Models\Admin;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use function Symfony\Component\Console\Style\table;
use function Symfony\Component\Mime\Header\has;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminRecoards = [
            [
                'name' => 'admin',
                'type' => 'subadmin',
                'mobile' => '01746755225',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin12123'),
                'photo' => '',
                'status' => 1,
            ],
            [
                'name' => 'kawsar',
                'type' => 'admin',
                'mobile' => '01746755225',
                'email' => 'kawsarfaz100@gmail.com',
                'password' => Hash::make('12123123'),
                'photo' => '',
                'status' => 1,
            ],

        ];
        DB::table('admins')->insert($adminRecoards);

//        foreach ($adminRecoards as  $recoard){
//            Admin::create($recoard);
//        }

    }
}
