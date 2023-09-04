@extends('app.layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('note.update') }}" method="POST">
        @csrf
        <!-- ログイン中のユーザーidをコントローラーに渡す -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <!-- noteのidをコントローラーに渡す -->
        <input type="hidden" name="note_id" value="{{ $note->id }}">


        <div class="text-right">
            <button type="submit" name="submit" class="btn btn-primary">更新する</button>
            <button type="submit" name="draft" class="btn btn-info">下書き保存</button>
            <button name="note_favorite" class="btn btn-warning">お気に入り</button>
        </div>
        <h2 class="h2-designed text-center">基本情報</h2>
        <div class="">
            <div class="form-group mb-3">
                <label class="form-label">書名</label>
                <input type="text" name="note_title" class="form-control" value="{{ $note->note_title }}">
                @if ($errors->has('planed_book_title'))
                <div class="text-danger">
                    {{ $errors->first('planed_book_title') }}
                </div>
                @endif
            </div>

            <label class="form-label">著者</label>
            <div id="author-plus" class="btn btn-primary btn-sm">著者を追加</div>
            <div id="author-area" class="form-group">
                @foreach($note->authors as $author)
                <div class="unit input-group mb-2">
                    <input type="hidden" name="author_id[]" value="{{ $author->id }}">
                    <input name="author_name[]" type="text" class="form-control" value="{{ $author->author_name }}">
                    <div class="author-minus input-group-append">
                        <span class="btn btn-danger">×</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">出版社</label>
                    <input type="text" name="note_publisher" class="form-control" value="{{ $note->note_publisher }}">
                </div>
                <div class="col">
                    <label for="customRange1" class="form-label">評価 : <span><span id="current-score"></span>点</span></label><br>
                    <input class="input-range" type="range" name="note_score" id="range" min="0" max="100" value="{{ $note-> note_score }}">
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">読書開始</label>
                    <input type="date" class="form-control" name="note_start_reading" value="{{ $note->note_start_reading }}">
                </div>
                <div class="col">
                    <label class="form-label">読書終了</label>
                    <input type="date" class="form-control" name="note_end_reading" value="{{ $note->note_end_reading }}">
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">大分類を選択</label>
                    <select class="form-select" id="big-genre" name="big-genre_id">
                        <option value="{{ $note->bigGenre->id }}" selected hidden>{{ $note->bigGenre->big_genre_name }}</option>
                        
                        @foreach($bigGenres as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">小分類を選択</label>
                    <select class="form-select" name="small-genre_id" id="small-genre_select">
                        <option value="{{ $note->smallGenre->id }}" selected hidden>{{ $note->smallGenre->small_genre_name }}</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">概要・あらすじ</label>
                <textarea class="form-control" name="note_outline" rows="3">{{ $note->note_outline }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">感想</label>
                <textarea class="form-control" name="note_impression" rows="3">{{ $note->note_impression }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">メモ</label>
                <textarea class="form-control" name="note_memo" rows="3">{{ $note->note_memo }}</textarea>
            </div>
        </div>

        <h2 class="h2-designed text-center">抜粋・シーンを記録</h2>



        <div class="form-group" id="sentence-area">

            @foreach($sentences as $sentence)
            <div class="unit">
                <input type="hidden" name="sentence_id[]" value="{{ $sentence->id}} ">
                <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                    <div class="form-group row">
                        <div class="col-3 mb-3">
                            <label class="form-label">ページ数</label>
                            <input type="text" class="form-control" name="sentence_page[]" value="{{ $sentence->sentence_page }}">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">タグ</label>
                            <select class="form-select" name="tag[]" id="tag_select">
                                @foreach($tags as $key => $value)
                                <option value="{{ $key }}" {{ $sentence->tag_id == $key? 'selected': ''}}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="form-group mb-3">
                            <label class="form-label">抜粋・シーン</label>
                            <textarea class="form-control" name="sentence_body[]" rows="3">{{ $sentence->sentence_body }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">コメント</label>
                            <textarea class="form-control" name="sentence_memo[]" rows="1">{{ $sentence->sentence_memo }}</textarea>
                        </div>
                        <div class="text-center">
                            <span id="sentence-num"></span>
                            <span class="btn btn-danger" id="sentence-delete" style="margin-bottom: 1.em">削除</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="btn btn-primary" id="sentence-add">抜粋フォームを追加</div>

    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script>
    // セレクトボックスの連動
    // 親カテゴリのselect要素が変更になるとイベントが発生
    $('#big-genre').change(function() {
        var big_genre_id = $(this).val();

        async function getSmallGenre() {
            
            try {
                

                const endpoint = '/note/genre'
                const data = {
                    'big_genre_name': big_genre_id
                }

                const response = await fetch(endpoint, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'

                    },
                    body: JSON.stringify(data)
                })
                const dataResponse = await response.json();
                
                // 小ジャンルセレクトのoptionを一旦削除
                $('#small-genre_select option').remove();
                    // DBから受け取ったデータを小ジャンルセレクトのoptionにセット
                    console.log(dataResponse);
                    $.each(dataResponse, function(key, value) {
                        $('#small-genre_select').append($('<option>').text(value).attr('value', key));
                    });
            } catch(error) {
                console.log('Error', error)
            }   
        }

        getSmallGenre();
    })
</script>
@endsection