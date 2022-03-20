<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(AdminsTableSeeder::class);
//        $this->call(SectionsTableSeeder::class);

        $this->call([
                AdminsTableSeeder::class,
                SectionsTableSeeder::class
            ]);

        // \App\Models\User::factory(10)->create();
    }
}
