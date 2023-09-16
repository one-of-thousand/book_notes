<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'tag_name' => '未選択'
        ]);
        Tag::create([
            'tag_name' => '冒頭文'
        ]);
        Tag::create([
            'tag_name' => '末尾文'
        ]);
        Tag::create([
            'tag_name' => 'シーン・あらすじ'
        ]);
        Tag::create([
            'tag_name' => '格言・警句'
        ]);
        Tag::create([
            'tag_name' => '比喩表現'
        ]);
        Tag::create([
            'tag_name' => 'セリフ・会話'
        ]);
        Tag::create([
            'tag_name' => '思考・考え方'
        ]);
        Tag::create([
            'tag_name' => '情景描写'
        ]);
        Tag::create([
            'tag_name' => '文章技法'
        ]);
        Tag::create([
            'tag_name' => '語句・語法'
        ]);
        Tag::create([
            'tag_name' => 'データ'
        ]);
    }
}
