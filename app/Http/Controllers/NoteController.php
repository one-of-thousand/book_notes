<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * ホーム画面を表示
     */
    public function noteHome() {
        return view('app.bookNotes.home');
    }

    
    
    /**
     * note登録画面を表示
     */
    public function noteCreate() {
        return view('app.bookNotes.noteForm');
    }

    /**
     * note一覧画面を表示
     */
    public function noteIndex(){
        return view('app.booknotes.noteIndex');
    }

    /**
     * 抜粋一覧画面を表示
     */
    public function sentenceIndex(){
        return view('app.booknotes.sentenceIndex');
    }

    /**
     * タグ一覧画面を表示
     */
    public function tagIndex() {
        return view('app.booknotes.tagIndex');
    }


    /**
     * note詳細画面を表示
     */
    public function noteDetail(){
        return view('app.booknotes.noteDetail');
    }






}
