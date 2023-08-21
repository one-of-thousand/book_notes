@extends('app.layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('note.store') }}">
        <!-- ログイン中のユーザーidをコントローラーに渡す -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        
        <div class="text-right">
            <button type="submit" name="submit" class="btn btn-primary">登録する</button>
            <button type="submit" name="draft" class="btn btn-info">下書き保存</button>
            <button name="note_favorite" class="btn btn-warning">お気に入り</button>
        </div>
        <h2>基本情報</h2>
        <div class="">
            <div class="form-group mb-3">
                <label class="form-label">書名</label>
                <input type="text" name="note_title" class="form-control" placeholder="例）吾輩は猫である">
                @if ($errors->has('planed_book_title'))
                <div class="text-danger">
                    {{ $errors->first('planed_book_title') }}
                </div>
            @endif
            </div>

            <label class="form-label">著者</label>
            <div id="author-plus" class="btn btn-primary btn-sm">著者を追加</div>
            <div id="author-area" class="form-group">
                <div class="unit input-group mb-2">
                    <input name="author_name[]" type="text" class="form-control" placeholder="例）夏目漱石">
                    <div class="author-minus input-group-append">
                        <span class="btn btn-danger">×</span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">出版社</label>
                    <input type="text" name="note_publisher" class="form-control" placeholder="例）新潮社">
                </div>
                <div class="col">
                    <label for="customRange1" class="form-label">評価 : <span><span id="current-score"></span>点</span></label><br>
                    <input class="input-range" type="range" name="note_score" id="range" min="0" max="100" value="50">
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">読書開始</label>
                    <input type="date" class="form-control" name="note_start_reading">
                </div>
                <div class="col">
                    <label class="form-label">読書終了</label>
                    <input type="date" class="form-control" name="note_end_reading">
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">大分類を選択</label>
                    <select class="form-select" id="big-genre" name="big-genre_id">
                        
                        <option value="7" selected>未選択</option>
                        @foreach($bigGenres as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">小分類を選択</label>
                    <select class="form-select" name="small-genre_id" id="small-genre_select">
                        <option value="62" selected>未選択</option>
                        <!-- <option value=""></option>
                        @foreach ($smallGenres as $index => $name)
                            <option value="{{ $index }}">{{ $name }}</option>
                        @endforeach -->
                        
                    </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">概要・あらすじ</label>
                <textarea class="form-control" name="note_outline" rows="3"></textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">感想</label>
                <textarea class="form-control" name="note_impression" rows="3"></textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">メモ</label>
                <textarea class="form-control" name="note_memo" rows="3"></textarea>
            </div>
        </div>

        <h2>抜粋・シーンを記録</h2>

        

        <div class="form-group" id="sentence-area">
            <div class="unit">
                <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                    <div class="form-group row">
                        <div class="col-3 mb-3">
                            <label class="form-label">ページ数</label>
                            <input type="text" class="form-control" name="sentence_page[]">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">タグ</label>
                            <select class="form-select" name="tag[]">
                                <option hidden>選択してください</option>
                                @foreach($tags as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="col-3 mb-3">
                            <label class="form-label">タグ2</label>
                            <select class="form-select" name="tags[]">
                                <option hidden></option>
                                <option>冒頭文</option>
                                <option>末尾文</option>
                                <option>比喩表現</option>
                                <option>心情描写</option>
                            </select>
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">タグ3</label>
                            <select class="form-select" name="tags[]">
                                <option hidden></option>
                                <option>冒頭文</option>
                                <option>末尾文</option>
                                <option>比喩表現</option>
                                <option>心情描写</option>
                            </select>
                        </div> -->

                    </div>
                    <div class="form-group">
                        <div class="form-group mb-3">
                            <label class="form-label">抜粋・シーン</label>
                            <textarea class="form-control" name="sentence_body[]" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">コメント</label>
                            <textarea class="form-control" name="sentence_memo[]" rows="1"></textarea>
                        </div>
                        <div class="text-center">
                            <span id="sentence-num"></span>
                            <span class="btn btn-danger" id="sentence-delete" style="margin-bottom: 1.em">削除</span>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="btn btn-primary" id="sentence-add">抜粋フォームを追加</div>

    </form>
</div>

<script
  src="https://code.jquery.com/jquery-3.5.0.min.js"
  integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
  crossorigin="anonymous"></script>
<script>
    // セレクトボックスの連動
    // 親カテゴリのselect要素が変更になるとイベントが発生
    $('#big-genre').change(function () {


        var big_genre_id = $(this).val();

        console.log(big_genre_id);

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            url: '/note/genre',
            type: 'POST',
            data: {'big_genre_name' : big_genre_id},
            datatype: 'json',
        })
        .done(function(data) {
        // 小ジャンルセレクトのoptionを一旦削除
        $('#small-genre_select option').remove();
        // DBから受け取ったデータを小ジャンルセレクトのoptionにセット
        console.log(data);
        $.each(data, function(key, value) {
            $('#small-genre_select').append($('<option>').text(value).attr('value', key));
        });
    })
    .fail(function() {
        console.log('失敗');
    });
    })
</script>
@endsection