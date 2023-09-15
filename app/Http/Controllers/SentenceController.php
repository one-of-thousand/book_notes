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
    public function sentenceIndex(Request $request) {
        //ユーザーの持つ抜粋文の全件を取得
        $query = Auth::user()->sentences();
        
        //検索単語が入力されていれば、絞り込み
        $searchWord = $request->searchWord;
        if(isset($searchWord)) {
            $query->where(function($query) use($searchWord) {
                $query->where('sentence_body', 'LIKE', "%{$searchWord}%")
                    ->orwhere('sentence_memo', 'LIKE', "%{$searchWord}%");
            });
        }

        //件数表示用
        $sentenceCount = $query->get();

        //クエリ実行
        $sentences = $query->orderBy('updated_at', 'desc')->paginate(10);

        
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

        //バリデーション
        $request->validate([
            'sentence_page' => 'nullable | regex:/^[0-9]+$/',
            'sentence_body' => 'required | max:1500',
            'sentence_memo' => 'max:300',
        ],
        [
        'sentence_page.regex' => '半角数字で入力してください。',  
        'sentence_body.required' => '文章内容は必須項目です。',  
        'sentence_body.max' => '1500文字以下で入力してください。',  
        'sentence_memo.max' => '300文字以下で入力してください。',  
        ]);

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
