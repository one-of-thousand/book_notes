<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanedBook;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\BigGenre;
use App\Models\Note;
use App\Models\SmallGenre;
use App\Models\Tag;
use App\Models\Author;
use App\Models\Sentence;
use Illuminate\Support\Facades\Session;

class NoteController extends Controller
{
    //未認証の場合はログイン画面に遷移
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * note登録画面を表示
     */
    public function noteCreate() {
        // セレクトボックスのリストを取得
        $bigGenres = BigGenre::pluck('big_genre_name', 'id');
        $smallGenres = SmallGenre::pluck('small_genre_name', 'id');
        $tags = Tag::pluck('tag_name', 'id');

        // dd($smallGenres);

        return view('app.bookNotes.noteForm', compact('bigGenres', 'smallGenres', 'tags'));
    }

    /**
     * ajaxによる小ジャンル取得・表示
     * 
     * 
     */
    public function noteSmallGenreSelect(Request $request) {
        $id = request()->get('big_genre_name');
        $smallGenreName = SmallGenre::where('big_genre_id', $id)->get();
        $result = [];

        foreach($smallGenreName as $item){
            $result[$item->id] = $item->small_genre_name;
        }

        return response()->json($result);
    }

    /**
     * note登録処理を実行
     */
    public function noteStore(Request $request) {
        $notes = $request->all();
        // dd($notes);

        
        

        
        // //バリデーション
        // $request->validate([
        //     'note_title' => 'required',
        //     'note_start_reading' => 'date | before:today',
        //     'note_end_reading' => 'date | after:note_start_reading',
            
        // ]);
        // dd($notes);

        //登録処理
        //notesテーブルへの登録
        $note_items = new Note;
        $note_items->user_id = Auth::user()->id;
        $note_items->note_title = $request->get('note_title');
        $note_items->note_start_reading = $request->get('note_start_reading');
        $note_items->note_end_reading = $request->get('note_end_reading');
        $note_items->note_memo = $request->get('note_memo');
        $note_items->note_publisher = $request->get('note_publisher');
        $note_items->big_genre_id = $request->get('big-genre_id');
        $note_items->small_genre_id = $request->get('small-genre_id');
        $note_items->note_score = $request->get('note_score');
        $note_items->note_outline = $request->get('note_outline');
        $note_items->note_impression = $request->get('note_impression');
        $note_items->save();

        //authorsテーブルへの登録
        //noteのidを取得
        $lastInsertNoteId = $note_items->id;
        //requestからauthorの配列を取得
        $author_list = $request->get('author_name');

        foreach($author_list as $value) {
            $author = new Author;
            $author->note_id = $lastInsertNoteId;
            $author->author_name = $value;
            $author->save();
        }
        // dd($lastInsertNoteId);

        //sentencesテーブルへの登録
        //各フォームの配列を変数に保存
        $page_list = $request->get('sentence_page');
        $tag_list = $request->get('tag');
        $sentence_body_list = $request->get('sentence_body');
        $sentence_memo_list = $request->get('sentence_memo');
        $sentence_count = count($request->get('sentence_body'));

        for($i=0; $i<$sentence_count; $i++) {
            $sentences = new Sentence;
            $sentences->user_id = Auth::user()->id;
            $sentences->note_id = $lastInsertNoteId;
            $sentences->sentence_page = $page_list[$i];
            $sentences->sentence_body = $sentence_body_list[$i];
            $sentences->sentence_memo = $sentence_memo_list[$i];
            $sentences->tag_id = $tag_list[$i];
            $sentences->save();
        }

        return redirect(route('note.index'));
    }

    /**
     * note一覧画面を表示
     */
    public function noteIndex(){
        //ユーザーが保持するNoteとsentenceを取得
        $notes = Auth::user()->notes()->orderBy('created_at', 'desc')->paginate(5);
        $notesCount = Auth::user()->notes()->get();//件数表示用
        $sentences = Auth::user()->sentences()->get();


        return view('app.booknotes.noteIndex', compact(
            'notes',
            'sentences',
            'notesCount'
        ));
    }

    /**
     * note詳細画面を表示
     * 
     * @param int $id
     * @return view
     */
    public function noteDetail($id){
        $note = Note::find($id);
        $sentences = Sentence::where('note_id', '=', $note->id)->get();
        // dd($note->id);
        // dd($sentence);

        // dd($note);

        if(is_null($note)) {
            Session::flash('err_msg', 'データがありません');
            return redirect(route('note.index'));
        }

        return view('app.booknotes.noteDetail', compact('note', 'sentences'));
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


    





}
