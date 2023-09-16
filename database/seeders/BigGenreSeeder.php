<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BigGenre;

class BigGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BigGenre::create([
            'big_genre_name' => '未選択'
        ]);
        BigGenre::create([
            'big_genre_name' => '小説・文学',
        ]);
        BigGenre::create([
            'big_genre_name' => '文芸作品',
        ]);
        BigGenre::create([
            'big_genre_name' => 'ノンフィクション',
        ]);
        BigGenre::create([
            'big_genre_name' => 'ビジネス・経済',
        ]);
        BigGenre::create([
            'big_genre_name' => '教養',
        ]);
        BigGenre::create([
            'big_genre_name' => '趣味・実用',
        ]);
        
    }
}
