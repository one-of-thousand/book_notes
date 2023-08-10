<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PlanedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PlanedBookRequest;
use PHPUnit\Event\Code\Throwable;
use Illuminate\Support\Facades\DB;

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
        //エラーなければ、削除実行
        // try {
            
        // } catch(Throwable $e) {
        //     abort(500);
        // }
        PlanedBook::destroy($id);
        
        Session::flash('err_msg', '削除しました。');
        return redirect(route('note.home'));
    }
}
