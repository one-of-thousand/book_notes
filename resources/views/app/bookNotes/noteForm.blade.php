@extends('app.layouts.app')
@section('title', 'Note新規登録')
@section('content')
<div class="container">
    <form action="{{ route('note.store') }}" method="POST">
        @csrf
        <!-- ログイン中のユーザーidをコントローラーに渡す -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">

        <div class="text-end">
            <button type="submit" name="submit" class="btn btn-primary">登録する</button>
        </div>
        <h2 class="h2-designed text-center">基本情報</h2>
        <div class="">
            <div class="form-group mb-3">
                <label class="form-label">書名</label>
                <input type="text" value="{{ old('note_title') }}" name="note_title" class="form-control" placeholder="例）吾輩は猫である">

                @if($errors->has('note_title'))
                <div class="text-danger">{{ $errors->first('note_title') }}</div>
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
            @if($errors->has('author_name'))
            <div class="text-danger">{{ $errors->first('author_name') }}</div>
            @endif

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">出版社</label>
                    <input type="text" value="{{ old('note_publisher') }}" name="note_publisher" class="form-control" placeholder="例）新潮社">
                </div>
                @if($errors->has('note_publisher'))
                <div class="text-danger">{{ $errors->first('note_publisher') }}</div>
                @endif
                <div class="col">
                    <label for="customRange1" class="form-label">評価 : <span><span id="current-score"></span>点</span></label><br>
                    <input class="input-range" type="range" name="note_score" id="range" min="0" max="100" value="50">
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">読書開始</label>
                    <input type="date" value="{{ old('note_start_reading') }}" class="form-control" name="note_start_reading">
                </div>
                @if($errors->has('note_start_reading'))
                <div class="text-danger">{{ $errors->first('note_start_reading') }}</div>
                @endif
                <div class="col">
                    <label class="form-label">読書終了</label>
                    <input type="date" class="form-control" value="{{ old('note_end_reading') }}" name="note_end_reading">
                </div>
                @if($errors->has('note_end_reading'))
                <div class="text-danger">{{ $errors->first('note_end_reading') }}</div>
                @endif
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">大分類を選択</label>
                    <select class="form-select" value="{{ old('big_genre_id') }}" id="big-genre" name="big-genre_id">

                        <option value="7" selected>未選択</option>
                        @foreach($bigGenres as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">小分類を選択</label>
                    <select class="form-select" value="{{ old('small_genre_id') }}" name="small-genre_id" id="small-genre_select">
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
                <textarea class="form-control" value="{{ old('note_outline') }}" name="note_outline" rows="3"></textarea>
            </div>
            @if($errors->has('note_outline'))
            <div class="text-danger">{{ $errors->first('note_outline') }}</div>
            @endif

            <div class="form-group mb-3">
                <label class="form-label">感想</label>
                <textarea class="form-control" value="{{ old('note_impression') }}" name="note_impression" rows="3"></textarea>
            </div>
            @if($errors->has('note_impression'))
            <div class="text-danger">{{ $errors->first('note_impression') }}</div>
            @endif

            <div class="form-group mb-3">
                <label class="form-label">メモ</label>
                <textarea class="form-control" value="{{ old('note_memo') }}" name="note_memo" rows="3"></textarea>
            </div>
            @if($errors->has('note_memo'))
            <div class="text-danger">{{ $errors->first('note_memo') }}</div>
            @endif
        </div>

        <h2 class="h2-designed text-center">抜粋・シーンを記録</h2>

        <div class="btn btn-primary mb-3" id="sentence-form-btn">抜粋文登録フォームを表示</div>

        <input type="hidden" id="unitCount" name="unitCount" value="{{ session()->has('unitCount') ? session('unitCount'):0 }}">


        <div id="sentence-form">
            <div class="form-group" id="sentence-area">
                @php
                $unitCount = session()->has('unitCount') ? session('unitCount'):0

                @endphp

                @if(session('unitCount') == 0)

                <div class="unit">
                    <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                        <div class="form-group row">
                            <div class="col-3 mb-3">
                                <label class="form-label">ページ数</label>
                                <input type="text" value="{{ old('sentence_page.0') }}" class="disabled-cancel form-control" name="sentence_page[]">
                            </div>
                            @if($errors->has('sentence_page'))
                            <div class="text-danger">{{ $errors->first('sentence_page.$i') }}</div>
                            @endif
                            <div class="col-3 mb-3">
                                <label class="form-label">タグ</label>
                                <select class="disabled-cancel form-select" value="{{ old('tag_id') }}" name="tag[]">
                                    <option hidden value="">選択してください</option>
                                    @foreach($tags as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-group mb-3">
                                <label class="form-label">抜粋・シーン</label>
                                <textarea class="disabled-cancel form-control" value="{{ old('sentence_body.0') }}" name="sentence_body[]" rows="3"></textarea>
                            </div>
                            @if($errors->has('sentence_body'))
                            <div class="text-danger">{{ $errors->first('sentence_body.0') }}</div>
                            @endif
                            <div class="form-group mb-3">
                                <label class="form-label">コメント</label>
                                <textarea class="disabled-cancel form-control" value="{{ old('sentence_memo.0') }}" name="sentence_memo[]" rows="1"></textarea>
                            </div>
                            @if($errors->has('sentence_memo'))
                            <div class="text-danger">{{ $errors->first('sentence_memo.0') }}</div>
                            @endif
                            <div class="text-center">
                                <span id="sentence-num"></span>
                                <span class="btn btn-danger sentence-delete" style="margin-bottom: 1.em">削除</span>
                            </div>
                        </div>
                    </div>
                </div>

                @endif


                @if(session('unitCount') >= 1)
                @for($i = 0; $i < $unitCount ; $i++) 
                    <div class="unit">
                        <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                            <div class="form-group row">
                                <div class="col-3 mb-3">
                                    <label class="form-label">ページ数</label>
                                    <input type="text" value="{{ old("sentence_page.{$i}") }}" class="disabled-cancel form-control" name="sentence_page[]">
                                </div>
                                @if($errors->has('sentence_page.*'))
                                <div class="text-danger">{{ $errors->first("sentence_page.{$i}") }}</div>
                                @endif
                                <div class="col-3 mb-3">
                                    <label class="form-label">タグ</label>
                                    <select class="disabled-cancel form-select" value="{{ old('tag_id') }}" name="tag[]">
                                        @foreach($tags as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="form-group mb-3">
                                    <label class="form-label">抜粋・シーン</label>
                                    <textarea class="disabled-cancel form-control" value="{{ old("sentence_body.{$i}") }}" name="sentence_body[]" rows="3"></textarea>
                                </div>
                                @if($errors->has('sentence_body.*'))
                                <div class="text-danger">{{ $errors->first("sentence_body.{$i}") }}</div>
                                @endif
                                <div class="form-group mb-3">
                                    <label class="form-label">コメント</label>
                                    <textarea class="disabled-cancel form-control" value="{{ old("sentence_memo.{$i}") }}" name="sentence_memo[]" rows="1"></textarea>
                                </div>
                                @if($errors->has('sentence_memo.*'))
                                <div class="text-danger">{{ $errors->first("sentence_memo.{$i}") }}</div>
                                @endif
                                <div class="text-center">
                                    <span id="sentence-num"></span>
                                    <span class="btn btn-danger sentence-delete" style="margin-bottom: 1.em">削除</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
                @endif
            </div>
            <div class="btn btn-primary" id="sentence-add">入力欄を追加</div>
        </div>
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
            } catch (error) {
                console.log('Error', error)
            }
        }

        getSmallGenre();
    })

    //抜粋文登録フォームを押すとフォーム表示
    $(document).ready(function() {

        if ($('#unitCount').val() == 0) {
            //初期は隠しておく
            $('#sentence-form').hide();
            $('.disabled-cancel').prop("disabled", true)
            $('#sentence-form-remove-btn').hide();
        } else {
            $('#sentence-form').show();
            $('#sentence-form-btn').hide();
        }


        //登録フォーム表示ボタンが押されたとき
        $('#sentence-form-btn').click(function() {
            $('#sentence-form-btn').hide();
            // $('#sentence-form-remove-btn').show();
            $('#sentence-form').show();
            $('.disabled-cancel').prop("disabled", false)

            //unitの数をセッションに保存するための値を入れる
            let unitCount = $('#unitCount').val();
            $('#unitCount').val(Number(unitCount) + 1);
            console.log($('#unitCount').val());

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

                //valueをnullにする
                inputListText.value = "";

                $('#author-area .unit').parent().append(element);
            }
        });
        $('.author-minus').on('click', function() {
            let inputCount = $('#author-area .unit').length;
            if (inputCount > minCount) {
                $(this).parents('.unit').remove();
            }
        });
    });

    //抜粋文フォームの追加・削除処
    $(function() {
        $('#sentence-add').on('click', function() {
            //要素(ひとつ前のフォーム)のクローンをする
            let element = $('#sentence-area .unit:last-child').clone(true);

            let inputList = element[0].querySelectorAll('input[type="text"], input[type="hidden"], textarea, select');

            for (let i = 0; i < inputList.length; i++) {
                inputList[i].value = "";
            }
            // 新しいフォームのタグには一番最初のoptionをセット
            element.find('select').prop('selectedIndex', 0)

            $('#sentence-area .unit').parent().append(element);

            //unitの数をセッションに保存するための値を入れる
            let unitCount = $('#unitCount').val();
            $('#unitCount').val(Number(unitCount) + 1);

            console.log($('#unitCount').val());


            //最下部にスクロール
            let elm = document.documentElement;

            //ページの最下部位置を保存
            let bottom = elm.scrollHeight - elm.clientHeight;

            //垂直方向に移動
            window.scroll(0, bottom);
        });

        //削除ボタンを押したときの処理
        $('.sentence-delete').on('click', function() {

            let inputCount = $('#sentence-area .unit').length;
            if (inputCount == 1) {
                $('#sentence-form-btn').show();
                // $('#sentence-form-remove-btn').hide();
                $('#sentence-form').hide();
                $('.disabled-cancel').prop("disabled", true)
            } else if (inputCount > 1) {
                $(this).parents('.unit').remove();
            }

            //unitの数をセッションに保存するための値を入れる
            let unitCount = $('#unitCount').val();
            $('#unitCount').val(Number(unitCount) - 1);
            console.log($('#unitCount').val());

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