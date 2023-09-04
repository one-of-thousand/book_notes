<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sentence;
use App\Models\Tag;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;


class SentenceController extends Controller
{
    /**
     * 文章一覧画面を表示
     */
    public function sentenceIndex() {
        //ユーザーの持つ抜粋文の全件を取得
        $sentences = Auth::user()->sentences()->orderBy('created_at', 'desc')->paginate(10);
        $sentenceCount = Auth::user()->sentences()->get();
        // dd($sentences);

        return view('app.bookNotes.sentenceIndex', compact('sentences', 'sentenceCount'));
    }

    /**
     * 文章詳細画面を表示
     * 
     * @return view
     */
    public function sentenceDetail($id) {
        $sentence = Sentence::find($id);
        

        // dd($sentence);

        return view('app.bookNotes.sentenceDetail', compact('sentence'));
    }

    /**
     * 文章編集画面を表示
     * 
     */
    public function sentenceEdit($id) {
        $sentence = Sentence::find($id);
        $tags = Tag::pluck('tag_name', 'id');
        return view('app.bookNotes.sentenceEdit', compact('sentence', 'tags'));
    }

    /**
     * 変更内容を保存
     */
    public function sentenceUpdate(Request $request) {
        $sentence = $request->all();
        // dd($sentence);
        DB::beginTransaction();
        try {
            // 更新処理を実行
            $sentence_item = Sentence::find($sentence['sentence_id']);
            $sentence_item->fill([
                'sentence_page' => $sentence['sentence_page'],
                'sentence_body' => $sentence['sentence_body'],
                'sentence_memo' => $sentence['sentence_memo'],
                'tag_id' => $sentence['tag_id'],
            ]);
            $sentence_item->save();
            DB::commit();
        }catch (\Throwable $e) {
            DB::rollBack();
            abort(500);
        }
        session()->flash('err_msg', '文章内容を更新しました');

        return redirect(route('sentence.index'));
    }

    /**
     * 削除を実行
     * 
     */
    public function sentenceDelete($id) {
        if(empty($id)) {
            session()->flash('err_msg', 'データがありません');
            return redirect(route('sentence.detail'));
        }

        try {
            Sentence::destroy($id);
        } catch(\Throwable $e) {
            abort(500);
        }
        
        session()->flash('err_msg', '削除が完了しました');

        return redirect(route('sentence.index'));
    }
}
