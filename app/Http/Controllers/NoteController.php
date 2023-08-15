<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanedBook;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * ホーム画面を表示
     */
    public function noteHome() {
        //読みたい本リストの一覧を表示
        $planedBooks = Auth::user()->planedBooks()->orderBy('created_at', 'desc')->paginate(5);
        // dd($planedBooks);
        //検索用のプルダウンリストを取得
        $importance = config('const.planedBook.importance');
        $state = config('const.planedBook.state');

        // dd($planedBooks);
        


        return view('app.bookNotes.home', compact('planedBooks', 'importance', 'state'));
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
