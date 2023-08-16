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
use Illuminate\Support\Facades\Auth;

class PlanedBookController extends Controller
{
    //未認証の場合はログイン画面に遷移
    public function __construct(){
        $this->middleware('auth');
    }
    
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
        // dd($inputs);

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
     * @param int $id
     * @return view
     */
    public function planedBookEdit($id) {
        //idから該当レコードを取得
        $planedBook = PlanedBook::find($id);

        // dd($planedBook);
        if (is_null($planedBook)) {
            Session::flash('err_msg', 'データがありません');
            return redirect(route('note.home'));
        }

        //重要度と状態のselect要素の値をconfigから取得
        $importance = config('const.planedBook.importance');
        $state = config('const.planedBook.state');

        return view('app.bookNotes.planedBookEdit', compact('planedBook', 'importance', 'state'));
    }


    /**
     * 更新処理の実行
     * 
     * @param int $id
     * @return view
     */
    public function planedBookUpdate(PlanedBookRequest $request) {
        //フォームの入力内容を取得
        $inputs = $request->all();
        // dd($inputs);

        //トランザクション処理の開始
        DB::beginTransaction();
        try {
            //登録処理を実行
            $planedBook = PlanedBook::find($inputs['id']);

            $planedBook->fill([
                'planed_book_title' => $inputs['planed_book_title'],
                'planed_book_author' => $inputs['planed_book_author'],
                'planed_book_importance' => $inputs['planed_book_importance'],
                'planed_book_state' => $inputs['planed_book_state'],
            ]);
            $planedBook->save();
            DB::commit();
        } catch(Throwable $e) {
            abort(500);
        }

        //セッションに登録完了メッセージを保存
        Session::flash('err_msg',  'リストを更新しました！');

        return redirect(route('note.home'));
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

    // /**
    //  * 検索を実行
    //  * 
    //  * @return view
    //  */
    // public function planedBookSearch(Request $request) {
    //     //カウント用に全件取得
        
    //     //検索ボックスから値を取得
    //     $searchWord = $request->searchWord;
    //     $selectImportance = $request->importance;
    //     $selectState = $request->state;
        
    //     // dd($searchWord, $importance, $state);

    //     //まずはユーザーごとのリスト全件取得。get()はのちほど
    //     $query = Auth::user()->planedBooks();

    //     //条件によってクエリを変化
    //     if(isset($searchWord)){
    //         $query->where(function($query) use($searchWord) {
    //             $query->where('planed_book_title', 'LIKE', "%{$searchWord}%")
    //                     ->orwhere('planed_book_author', 'LIKE', "%{$searchWord}%");
    //         });
    //     }
    //     if(isset($selectImportance)) {
    //         $query->where(function($query) use($selectImportance) {
    //             $query->where('planed_book_importance', $selectImportance);
    //         });
    //     }
    //     if(isset($selectState)) {
    //         $query->where(function($query) use($selectState) {
    //             $query->where('planed_book_state', $selectState);
    //         });
    //     }

        
        
    //     //実行結果を保存
    //     $planedBooks = $query->orderBy('created_at', 'desc')->paginate(5);
        
    //     //件数表示用
    //     $planedBooksCount = $query->get();
        
    //     // dd($planedBooks);

    //     //検索用のプルダウンリストを取得
    //     $importance = config('const.planedBook.importance');
    //     $state = config('const.planedBook.state');

    //     return view('app.bookNotes.home', compact('planedBooks', 'planedBooksCount', 'importance', 'state'));
    // }

    
}
