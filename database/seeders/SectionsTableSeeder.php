<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Console\Style\table;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SectionRecoards = [
            ['name'=>'Man','status'=>1 ],
            ['name'=>'Woman','status'=>1 ],
            ['name'=>'Kids','status'=>1 ],
        ];

        DB::table('sections')->insert($SectionRecoards);
        /*Section::insert($SectionRecoards);*/
    }
}
