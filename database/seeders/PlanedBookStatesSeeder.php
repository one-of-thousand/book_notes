<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Planed_Book_State;
use Illuminate\Support\Facades\DB;

class PlanedBookStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('planed_book_states')->insert([
            'planed_book_states_name' => '気になる'
        ]);
        DB::table('planed_book_states')->insert([
            'planed_book_states_name' => '入手中'
        ]);
        DB::table('planed_book_states')->insert([
            'planed_book_states_name' => '入手済み'
        ]);
        DB::table('planed_book_states')->insert([
            'planed_book_states_name' => '積ん読'
        ]);
        DB::table('planed_book_states')->insert([
            'planed_book_states_name' => '読書中'
        ]);
    }
}
