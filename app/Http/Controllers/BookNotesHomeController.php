<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookNotesHomeController extends Controller
{
    //未認証の場合はログイン画面に遷移
    public function __construct(){
        $this->middleware('auth');
      }
    
    /**
     * ホーム画面を表示。同時に検索も。
     */
    public function noteHome(Request $request) {
        //検索ボックスから値を取得
        $searchWord = $request->searchWord;
        $selectImportance = $request->importance;
        $selectState = $request->state;
        
        //まずはユーザーが登録しているリスト全件取得。get()はのちほど
        $query = Auth::user()->planedBooks();

        //条件によってクエリを変化。ページ遷移でhome画面表示ならここは全スルー
        if(isset($searchWord)){
            $query->where(function($query) use($searchWord) {
                $query->where('planed_book_title', 'LIKE', "%{$searchWord}%")
                        ->orwhere('planed_book_author', 'LIKE', "%{$searchWord}%");
            });
        }
        if(isset($selectImportance)) {
            $query->where(function($query) use($selectImportance) {
                $query->where('planed_book_importance', $selectImportance);
            });
        }
        if(isset($selectState)) {
            $query->where(function($query) use($selectState) {
                $query->where('planed_book_state', $selectState);
            });
        }

        //件数表示用に先に件数を取得
        $planedBooksCount = $query->get();

        //クエリを実行しページネーションしたレコードを取り出す
        $planedBooks = $query->orderBy('created_at', 'desc')->paginate(5);

        
        //検索用のプルダウンリストを定数から取得
        $importance = config('const.planedBook.importance');
        $state = config('const.planedBook.state');

        return view('app.bookNotes.home', compact('planedBooks', 'planedBooksCount', 'importance', 'state'));

        
    }

    //「\\」「%」「_」などの記号を文字としてエスケープさせる
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
}
