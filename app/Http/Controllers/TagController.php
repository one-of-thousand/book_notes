<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * タグ一覧画面を表示
     */
    public function tagIndex()
    {
        $tags = Tag::get();

        // dd($tags);
        return view('app.booknotes.tagIndex', compact('tags'));
    }
}
