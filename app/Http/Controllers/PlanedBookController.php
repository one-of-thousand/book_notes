<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlanedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PlanedBookRequest;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Support\Facades\DB;
use Psy\Command\WhereamiCommand;

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
    public function planedBookStore(PlanedBookRequest $request) {
        //フォームの入力内容を取得
        $inputs = $request->all();

        //トランザクション処理の開始
        DB::beginTransaction();
        try {
            //登録処理を実行
            PlanedBook::create($inputs);
            DB::commit();
        } catch(Throwable $e) {
            abort(500);
        }

        //セッションに登録完了メッセージを保存
        Session::flash('err_msg',  'リストを登録しました！');

        return redirect(route('note.home'));
    }


    /**
     * 編集画面を表示
     * 
     * @return view
     */
    public function planedBookEdit($id) {
        //idから該当レコードを取得
        $editPlanedBook = PlanedBook::find($id);

        return view('app.bookNotes.planedBookEdit', compact('editPlanedBook'));
    }



    /**
     * 削除を実行
     * 
     * @return view
     */
    public function planedBookDelete($id) {
        
        //データが空ならエラーメッセージを表示
        if(empty($id)) {
            Session::flash('err_msg', 'データがありません');
            return redirect(route('note.home'));
        }

        // エラーなければ、削除実行
        try {
            PlanedBook::destroy($id);    
        } catch(Throwable $e) {
            abort(500);
        }
        
        
        Session::flash('err_msg', '削除しました。');
        return redirect(route('note.home'));
    }

    /**
     * 検索を実行
     * 
     * @return view
     */
    public function planedBookSearch(Request $request) {
        $searchWord = $request->searchWord;
        $selectImportance = $request->importance;
        $selectState = $request->state;
        
        // dd($searchWord, $importance, $state);

        //まずは全件取得のクエリを生成。実行はまだ
        $query = PlanedBook::query();

        //単語と重要度と状態
        if(isset($searchWord) && isset($selectImportance) && isset($selectState)) {
            $query->where(function($query) use($searchWord) {
                $query->where('planed_book_title', 'LIKE', "%{$searchWord}%")
                        ->orwhere('planed_book_author', 'LIKE', "%{$searchWord}%");
            });
            $query->where(function($query) use($selectImportance) {
                $query->where('planed_book_importance', $selectImportance);
            });
            $query->where(function($query) use($selectState) {
                $query->where('planed_book_state', $selectState);
            });
        }
        
        //単語検索と重要度選択
        if (isset($searchWord) && isset($selectImportance)) {
            $query->where(function($query) use($searchWord) {
                $query->where('planed_book_title', 'LIKE', "%{$searchWord}%")
                        ->orwhere('planed_book_author', 'LIKE', "%{$searchWord}%");
            });
            $query->where(function($query) use($selectImportance) {
                $query->where('planed_book_importance', $selectImportance);
            });
        }

        //単語検索と状態選択
        if(isset($searchWord) && isset($selectState)) {
            $query->where(function($query) use($searchWord) {
                $query->where('planed_book_title', 'LIKE', "%{$searchWord}%")
                        ->orwhere('planed_book_author', 'LIKE', "%{$searchWord}%");
            });
            $query->where(function($query) use($selectState) {
                $query->where('planed_book_state', $selectState);
            });
        }

        //重要度選択と状態選択
        if(isset($selectImportance) && isset($selectState)) {
            $query->where(function($query) use($selectImportance) {
                $query->where('planed_book_importance', $selectImportance);
            });
            $query->where(function($query) use($selectState) {
                $query->where('planed_book_state', $selectState);
            });
        }

        //単語検索のみ
        if(isset($searchWord)) {
            $query->where('planed_book_title', 'LIKE', "%{$searchWord}%")
            ->orWhere('planed_book_author', 'LIKE', "%{$searchWord}%");
        }

        //重要度のみ
        if(!empty($selectImportance)){
            $query->where('planed_book_importance', $selectImportance);
        }

        //状態のみ
        if(!empty($selectState)){
            $query->where('planed_book_state', $selectState);
        }
        
        //実行結果を保存
        $planedBooks = $query->orderBy('created_at', 'desc')->paginate(5);
        // dd($planedBooks);

        //検索用のプルダウンリストを取得
        $importance = config('const.planedBook.importance');
        $state = config('const.planedBook.state');

        return view('app.bookNotes.home', compact('planedBooks', 'importance', 'state'));
    }

    //「\\」「%」「_」などの記号を文字としてエスケープさせる
    public static function escapeLike($str)
    {
        return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
    }
}
