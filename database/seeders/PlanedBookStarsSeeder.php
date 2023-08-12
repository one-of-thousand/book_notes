<?php

namespace Database\Seeders;

use App\Models\Planed_Book_Star;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanedBookStarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('planed_book_stars')->insert([
            'planed_book_stars_num' =>'★'
        ]);
        DB::table('planed_book_stars')->insert([
            'planed_book_stars_num' =>'★★'
        ]);
        DB::table('planed_book_stars')->insert([
            'planed_book_stars_num' =>'★★★'
        ]);
        DB::table('planed_book_stars')->insert([
            'planed_book_stars_num' =>'★★★★'
        ]);
        DB::table('planed_book_stars')->insert([
            'planed_book_stars_num' =>'★★★★★'
        ]);
    }
}
