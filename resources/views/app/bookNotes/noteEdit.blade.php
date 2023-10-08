@extends('app.layouts.app')
@section('title', 'Note編集')
@section('content')
<div class="container">
    <form action="{{ route('note.update') }}" method="POST" onsubmit="return checkSubmit()">
        @csrf
        <!-- ログイン中のユーザーidをコントローラーに渡す -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <!-- noteのidをコントローラーに渡す -->
        <input type="hidden" name="note_id" value="{{ $note->id }}">


        <div class="text-end">
            <button type="submit" name="submit" class="btn btn-primary">更新する</button>
        </div>
        <h2 class="h2-designed text-center">基本情報</h2>
        <div class="">
            <div class="form-group mb-3">
                <label class="form-label">書名</label>
                <input type="text" name="note_title" class="form-control" value="{{ $note->note_title }}">
                @if($errors->has('note_title'))
                <div class="text-danger">{{ $errors->first('note_title') }}</div>
                @endif
            </div>

            <label class="form-label">著者</label>
            <div id="author-plus" class="btn btn-primary btn-sm">著者を追加</div>
            <div id="author-area" class="form-group">
                @foreach($note->authors as $author)
                <div class="unit input-group mb-2">
                    <input class="delete-author-id" type="hidden" name="author_id[]" value="{{ $author->id }}">
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
            @if($errors->has('note_publisher'))
                <div class="text-danger">{{ $errors->first('note_publisher') }}</div>
            @endif

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">読書開始</label>
                    <input type="date" class="form-control" name="note_start_reading" value="{{ $note->note_start_reading }}">
                </div>
                @if($errors->has('note_start_reading'))
                <div class="text-danger">{{ $errors->first('note_start_reading') }}</div>
                @endif
                <div class="col">
                    <label class="form-label">読書終了</label>
                    <input type="date" class="form-control" name="note_end_reading" value="{{ $note->note_end_reading }}">
                </div>
                @if($errors->has('note_end_reading'))
                <div class="text-danger">{{ $errors->first('note_end_reading') }}</div>
                @endif
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
            @if($errors->has('note_outline'))
            <div class="text-danger">{{ $errors->first('note_outline') }}</div>
            @endif

            <div class="form-group mb-3">
                <label class="form-label">感想</label>
                <textarea class="form-control" name="note_impression" rows="3">{{ $note->note_impression }}</textarea>
            </div>
            @if($errors->has('note_impression'))
            <div class="text-danger">{{ $errors->first('note_impression') }}</div>
            @endif

            <div class="form-group mb-3">
                <label class="form-label">メモ</label>
                <textarea class="form-control" name="note_memo" rows="3">{{ $note->note_memo }}</textarea>
            </div>
            @if($errors->has('note_memo'))
            <div class="text-danger">{{ $errors->first('note_memo') }}</div>
            @endif
        </div>

        <h2 class="h2-designed text-center">抜粋・シーンを記録</h2>

        @if($errors->has('sentence_page.*') || $errors->has('sentence_body.*') || $errors->has('sentence_memo.*'))
            <div class="text-danger">
                入力に誤りがあります。以下をご確認ください<br>
                ・ページ数は空白か半角数字のみ<br>
                ・抜粋・シーンは入力が必須かつ1500文字以下<br>
                ・コメントは300文字以下
            </div>
        @endif

        <div class="form-group" id="sentence-area">

            <div class="btn btn-primary mb-3" id="sentence-form-btn">抜粋文登録フォームを表示</div>
            @if(!isset($sentences[0]))

            <div id="sentence-form1">
                <div class="unit">
                    <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                        <div class="form-group row">
                            <div class="col-3 mb-3">
                                <label class="form-label">ページ数</label>
                                <input type="text" class="form-control disabled-cancel" name="sentence_page[]">
                            </div>
                            @if($errors->has('sentence_page.*'))
                                <div class="text-danger">{{ $errors->first("sentence_page.{$i}") }}</div>
                            @endif
                            <div class="col-3 mb-3">
                                <label class="form-label">タグ</label>
                                <select class="form-select disabled-cancel" name="tag[]">
                                    @foreach($tags as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3">
                                <label class="form-label">抜粋・シーン</label>
                                <textarea class="form-control disabled-cancel" name="sentence_body[]" rows="3"></textarea>
                            </div>
                            @if($errors->has('sentence_body.*'))
                                <div class="text-danger">{{ $errors->first("sentence_body.{$i}") }}</div>
                            @endif

                            <div class="form-group mb-3">
                                <label class="form-label">コメント</label>
                                <textarea class="form-control disabled-cancel" name="sentence_memo[]" rows="1"></textarea>
                            </div>
                            @if($errors->has('sentence_memo.*'))
                                <div class="text-danger">{{ $errors->first("sentence_memo.{$i}") }}</div>
                            @endif

                            <div class="text-center">
                                <span class="btn btn-danger sentence-delete" style="margin-bottom: 1.em">削除</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else

            
            <div id="sentence-form2">
            @foreach($sentences as $sentence)
            
                <div class="unit">
                    <input class="disabled-cancel2 delete-sentence-id" type="hidden" name="sentence_id[]" value="{{ $sentence->id}}">
                    <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                        <div class="form-group row">
                            <div class="col-3 mb-3">
                                <label class="form-label">ページ数</label>
                                <input type="text" class="disabled-cancel2 form-control" name="sentence_page[]" value="{{ $sentence->sentence_page }}">
                            </div>
                            @if($errors->has('sentence_page.*'))
                                <div class="text-danger">{{ $errors->first("sentence_page") }}</div>
                            @endif

                            <div class="col-3 mb-3">
                                <label class="form-label">タグ</label>
                                <select class="disabled-cancel2 form-select" name="tag[]" id="tag_select">
                                    @foreach($tags as $key => $value)
                                    <option value="{{ $key }}" {{ $sentence->tag_id == $key? 'selected': ''}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3">
                                <label class="form-label">抜粋・シーン</label>
                                <textarea class="disabled-cancel2 form-control" name="sentence_body[]" rows="3">{{ $sentence->sentence_body }}</textarea>
                            </div>
                            @if($errors->has('sentence_body.*'))
                                <div class="text-danger">{{ $errors->first("sentence_body") }}</div>
                            @endif

                            <div class="form-group mb-3">
                                <label class="form-label">コメント</label>
                                <textarea class="disabled-cancel2 form-control" name="sentence_memo[]" rows="1">{{ $sentence->sentence_memo }}</textarea>
                            </div>
                            @if($errors->has('sentence_memo.*'))
                                <div class="text-danger">{{ $errors->first("sentence_memo") }}</div>
                            @endif
                            <div class="text-center">
                                <span id="sentence-num"></span>
                                <span class="btn btn-danger sentence-delete" style="margin-bottom: 1.em">削除</span>
                            </div>
                        </div>
                    </div>
                </div>
            

            @endforeach
            </div>
            @endif


        </div>

        <div class="btn btn-primary" id="sentence-add">抜粋フォームを追加</div>

    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script>
    //更新の確認
    function checkSubmit() {
        if(window.confirm('更新してよろしいですか')) {
            return true;
        } else {
            return false;
        }
    }
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
            } catch (error) {
                console.log('Error', error)
            }
        }

        getSmallGenre();
    });

    //抜粋文登録フォームを押すとフォーム表示
    $(document).ready(function() {
        //文章がない場合のフォームはdisabledにして非表示
        $('#sentence-form').hide();
        $('.disabled-cancel').prop("disabled", true)

        //登録フォーム表示ボタンが押されたとき
        $('#sentence-form-btn').click(function() {
            // フォーム表示ボタンを非表示
            $('#sentence-form-btn').hide();
            $('#sentence-form1').show();
            $('#sentence-form2').show();
            $('.disabled-cancel').prop("disabled", false)
            //最下部にスクロール
            let elm = document.documentElement;

            //ページの最下部位置を保存
            let bottom = elm.scrollHeight - elm.clientHeight;

            //垂直方向に移動
            window.scroll(0, bottom);
        })
    });

    //著者入力欄の増減処理
    $(function() {
        const minCount = 1;
        const maxCount = 4;
        $('#author-plus').on('click', function() {
            let inputCount = $('#author-area .unit').length;
            if (inputCount < maxCount) {
                //要素のクローンを追加
                let element = $('#author-area .unit:last-child').clone(true);
                let inputListText = element[0].querySelector('input[type="text"]');
                let inputListHidden = element[0].querySelector('input[type="hidden"]');

                //valueをnullにする
                inputListText.value = "";
                inputListHidden.value = "";

                $('#author-area .unit').parent().append(element);
            }
        });
        //削除ボタンを押したとき
        $('.author-minus').on('click', function() {
            let value = $(this).parent().find('.delete-author-id').attr("value");
            console.log(value);
            $('form').prepend('<input type="hidden" name="deleteAuthor[]" value="' + value + '">');

            let inputCount = $('#author-area .unit').length;
            if (inputCount > minCount) {
                $(this).parents('.unit').remove();
            }
        });
    });

    //抜粋文フォームの追加・削除処理
    $(document).ready(function() {
        //初期は隠しておく
        $('#sentence-form1').hide();
        $('#sentence-form2').show();
        $('.disabled-cancel1').prop("disabled", true)
        //文章が存在するか否かでフォーム追加ボタンの処理を変える
        if ($('#sentence-form2').length == 0) {
            $('#sentence-add').hide();
        } else {
            $('#sentence-form-btn').hide();
            $('#sentence-add').show();
        }

        //登録フォーム表示ボタンが押されたとき
        $('#sentence-form-btn').click(function() {
            $('#sentence-form-btn').hide();
            $('#sentence-form1').show();
            $('#sentence-form2').show();
            $('.disabled-cancel').prop("disabled", false);
            $('.disabled-cancel2').prop("disabled", false);
            $('#sentence-add').show();
            //最下部にスクロール
            let elm = document.documentElement;

            //ページの最下部位置を保存
            let bottom = elm.scrollHeight - elm.clientHeight;

            //垂直方向に移動
            window.scroll(0, bottom);
        })
    });

    //抜粋フォーム追加ボタンを押したときの処理（クローン作製）
    $(function() {
        $('#sentence-add').on('click', function() {
            //要素(ひとつ前のフォーム)のクローンをする
            let element = $('#sentence-area .unit:last-child').clone(true);

            let inputList = element[0].querySelectorAll('input[type="text"], input[type="hidden"], textarea, select');

            console.log(inputList);
            for (let i = 0; i < inputList.length; i++) {
                inputList[i].value = "";
            }
            // 新しいフォームのタグには一番最初のoptionをセット
            element.find('select').prop('selectedIndex', 0)

            $('#sentence-area .unit').parent().append(element);

            //最下部にスクロール
            let elm = document.documentElement;

            //ページの最下部位置を保存
            let bottom = elm.scrollHeight - elm.clientHeight;

            //垂直方向に移動
            window.scroll(0, bottom);
        });

        //削除ボタンを押したときの処理
        $('.sentence-delete').on('click', function() {

            let value = $(this).parent().parent().parent().parent().parent().find('.delete-sentence-id').attr("value");
            console.log(value);
            $('form').prepend('<input type="hidden" name="deleteSentence[]" value="' + value + '">');

            let inputCount = $('#sentence-area .unit').length;
            let form1Length = $('#sentence-form1').length;
            let form2Length = $('#sentence-form2').length;
            console.log(inputCount);

            if (inputCount > 1) {
                //unit要素が2以上なら、対象のunitを削除
                // console.log($(this).parents('.unit'));
                // console.log('1');
                $(this).parents('.unit').remove();
            } else if (form1Length == 1) {
                //表示されているのがform1の場合
                $('#sentence-form-btn').show();
                $('#sentence-form1').hide();
                $('.disabled-cancel').prop("disabled", true);
                $('#sentence-add').hide();
            } else if (form2Length == 1) {
                //form2が表示されている場合
                console.log('form2を選択');
                $('.disabled-cancel2').val("");
                $('.disabled-cancel2').prop("disabled", true);
                $('#sentence-add').hide();
                $('#sentence-form-btn').show();
                $('#sentence-form2').hide();
            }

            //最下部にスクロール
            let elm = document.documentElement;

            //ページの最下部位置を保存
            let bottom = elm.scrollHeight - elm.clientHeight;

            //垂直方向に移動
            window.scroll(0, bottom);

        });
    });


    /**
     * 評価のスライダー値をリアルタイムで表示
     */
    window.onload = function() {

        const inputElem = document.getElementById("range");
        //値の埋め込み先要素を取得
        const currentValue = document.getElementById('current-score');

        //現在の値を埋め込む関数
        const setCurrentValue = (val) => {
            currentValue.innerText = val;
        }

        //inputイベント時に値をセットする関数
        const rangeOnChange = (e) => {
            setCurrentValue(e.target.value);
        }

        //値の変更に合わせてイベントを発火する
        inputElem.addEventListener('input', rangeOnChange);
        //ページ読み込み時の値をセット
        setCurrentValue(inputElem.value);
    }
</script>
@endsection