<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlanedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PlanedBookController extends Controller
{
    /**
     * 読みたい本リストの登録画面を表示
     * 
     * @return view
     */
    public function planedBookCreate() {
        //重要度と状態のselect要素の値をconfigから取得
        $importance = config('const.planedBook.importance');
        $state = config('const.planedBook.state');

        return view('app.bookNotes.planedBookForm', compact('importance', 'state'));
    }


    /**
     * 読みたい本リストの登録を実行
     * 
     * @return view
     */
    public function planedBookStore(Request $request) {
        
        dd($request->all());
        PlanedBook::create();

        //セッションに登録完了メッセージを保存
        Session::flash('err_msg', '読みたい本リストを登録しました！');

        return redirect(route('note.home'));
    }

    
}
