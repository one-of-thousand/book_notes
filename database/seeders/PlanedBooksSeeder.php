<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanedBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('planed_books')->insert([
            'planed_book_title' =>'アヒルと鴨のコインロッカー',
            'planed_book_author' =>'伊坂幸太郎',
            'planed_book_star_id' =>'2',
            'planed_book_state_id' =>'2',

        ]);
        DB::table('planed_books')->insert([
            'planed_book_title' =>'恐怖の構造',
            'planed_book_author' =>'平山夢明',
            'planed_book_star_id' =>'3',
            'planed_book_state_id' =>'4',

        ]);
        DB::table('planed_books')->insert([
            'planed_book_title' =>'ペンギンハイウェイ',
            'planed_book_author' =>'森見登美彦',
            'planed_book_star_id' =>'1',
            'planed_book_state_id' =>'2',

        ]);
    }
}
