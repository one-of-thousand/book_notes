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
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class NoteController extends Controller
{
    //未認証の場合はログイン画面に遷移
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * note登録画面を表示
     */
    public function noteCreate()
    {
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
    public function noteSmallGenreSelect(Request $request)
    {
        $id = $request->input('big_genre_name');

        // dd($request);
        $smallGenreName = SmallGenre::where('big_genre_id', $id)->get();
        $result = [];

        foreach ($smallGenreName as $item) {
            $result[$item->id] = $item->small_genre_name;
        }

        return response()->json($result);
    }

    /**
     * note登録処理を実行
     */
    public function noteStore(Request $request)
    {
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
        DB::beginTransaction();
        try {
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

            foreach ($author_list as $value) {
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

            for ($i = 0; $i < $sentence_count; $i++) {
                $sentences = new Sentence;
                $sentences->user_id = Auth::user()->id;
                $sentences->note_id = $lastInsertNoteId;
                $sentences->sentence_page = $page_list[$i];
                $sentences->sentence_body = $sentence_body_list[$i];
                $sentences->sentence_memo = $sentence_memo_list[$i];
                $sentences->tag_id = $tag_list[$i];
                $sentences->save();
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(500);
        }


        return redirect(route('note.index'));
    }

    /**
     * note一覧画面を表示
     */
    public function noteIndex()
    {
        //ユーザーが保持するNoteとsentenceを取得
        $notes = Auth::user()->notes()->orderBy('created_at', 'desc')->paginate(5);

        // $authors = Note::find($notes->id)->authors()->get();

        // dd($authors);
        $notesCount = Auth::user()->notes()->get(); //件数表示用
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
    public function noteDetail($id)
    {
        $note = Note::find($id);
        $authors = Author::where('note_id', '=', $id)->get();

        // dd($authors);
        $sentences = Sentence::where('note_id', '=', $note->id)->get();
        // dd($note->id);
        // dd($sentence);

        // dd($note);

        if (is_null($note)) {
            Session::flash('err_msg', 'データがありません');
            return redirect(route('note.index'));
        }

        return view('app.booknotes.noteDetail', compact('note', 'sentences', 'authors'));
    }

    /**
     * note更新画面を表示
     * 
     * @return view
     */
    public function noteEdit($id)
    {
        $note = Note::find($id);

        $sentences = Sentence::where('note_id', '=', $id)->get();
        

        // dd($sentences);


        $bigGenres = BigGenre::pluck('big_genre_name', 'id');
        $smallGenres = SmallGenre::pluck('small_genre_name', 'id');
        $tags = Tag::pluck('tag_name', 'id');

        // dd($note->sentences);
        // dd($bigGenres);
        // dd($note);
        return view('app.booknotes.noteEdit', compact(
            'note',
            'bigGenres',
            'smallGenres',
            'tags',
            'sentences'
        ));
    }


    /**
     * note更新処理を実行
     */
    public function noteUpdate(Request $request)
    {
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
        DB::beginTransaction();
        try {
            //notesテーブルへの登録
            $note_items = Note::find($notes['note_id']);

            // dd($notes['user_id']);

            $note_items->fill([
                'user_id' => $notes['user_id'],
                'note_title' => $notes['note_title'],
                'note_start_reading' => $notes['note_start_reading'],
                'note_end_reading' => $notes['note_end_reading'],
                'note_memo' => $notes['note_memo'],
                'note_publisher' => $notes['note_publisher'],
                'big_genre_id' => $notes['big-genre_id'],
                'small_genre_id' => $notes['small-genre_id'],
                'note_score' => $notes['note_score'],
                'note_outline' => $notes['note_outline'],
                'note_impression' => $notes['note_impression'],
            ]);
            $note_items->save();

            //authorsテーブルへの登録
            //requestからauthorの配列を取得
            $author_name_list = $request->get('author_name');
            $author_id_list = $request->get('author_id');
            $author_count = count($author_name_list);
            
            for($i = 0; $i < $author_count; $i++) {
                if(DB::table('authors')->where('id', $author_id_list[$i])->exists()) {
                    //名前入力があり、かつ、idがすでにDBにある場合
                    //対象レコードを更新
                    $author_item = Author::find($author_id_list[$i]);
                    $author_item->fill([
                        'author_name' => $author_name_list[$i]
                    ]);
                    $author_item->save();

                } else if(isNull($author_id_list[$i])) {
                    //新規登録処理
                    $author = new Author;
                    $author->note_id = $notes['note_id'];
                    $author->author_name = $author_name_list[$i];
                    $author->save();
                }
            }

            

            //sentencesテーブルへの登録
            //各フォームの配列を変数に保存
            $page_list = $request->get('sentence_page');
            $tag_list = $request->get('tag');
            $sentence_body_list = $request->get('sentence_body');
            $sentence_memo_list = $request->get('sentence_memo');
            $sentence_count = count($request->get('sentence_body'));
            $sentence_id = $request->get('sentence_id');

            for ($i = 0; $i < $sentence_count; $i++) {
                if(isset($sentence_id[$i])) {
                    $sentence_items = Sentence::find($sentence_id[$i]);
                    $sentence_items->fill([
                        'sentence_page' => $page_list[$i],
                        'sentence_body' => $sentence_body_list[$i],
                        'sentence_memo' => $sentence_memo_list[$i],
                        'tag_id' => $tag_list[$i]
                    ]);
                    $sentence_items->save();
                } else {
                    $sentences = new Sentence;
                    $sentences->user_id = $notes['user_id'];
                    $sentences->note_id = $notes['note_id'];
                    $sentences->sentence_page = $page_list[$i];
                    $sentences->sentence_body = $sentence_body_list[$i];
                    $sentences->sentence_memo = $sentence_memo_list[$i];
                    $sentences->tag_id = $tag_list[$i];
                    $sentences->save();
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            abort(500);
        }

        return redirect(route('note.index'));
    }

    /**
     * Note削除の実行
     */
    public function noteDelete($id) {
        dd($id);

        if(empty($id)) {
            session()->flash('err_msg', 'データがありません');
            return redirect(route('note.index'));
        }

        try {
            Note::destroy($id);
        } catch(\Throwable $e) {
            DB::rollBack();
            abort(500);
        }
        
        session()->flash('err_msg', '削除が完了しました');

        return redirect(route('note.index'));
    }

    
}
