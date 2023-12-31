@extends('app.layouts.app')
@section('title', 'ホーム')
@section('content')
<!-- 共通 -->

<div id="reading-data" class="container">
    <h2 class="text-center h2-designed">これまでの読書データ</h2>
    <div class="mb-2 center-block">
        <div class="text-center"><button class="btn btn-primary w-50" onclick="location.href='/note/create'">新たにNoteを書く</button></div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th class="col-4">Note総数</th>
            <th class="col-4">抜粋文総数</th>
            
        </tr>
        <tr>
            <td class="col-4">{{ $noteNum }}件</td>
            <td class="col-4">{{ $sentenceNum }}文</td>
            
        </tr>
    </table>
</div>

<div class="container p-2">
    <h2 class="text-center h2-designed">読みたい本リスト</h2>
    <a href="{{ route('planedBook.create') }}">
        <div class="btn btn-primary mx-4" id="">新規追加</div>
    </a>
    @if (session('err_msg'))
    <p class="text-danger">
        {{ session('err_msg') }}
    </p>
    @endif

    

    <!-- 追加ボタンと検索フォーム -->
    <form method="GET" action="{{ route('note.home') }}" class="p-1">
        <div class="bg-light m-2 p-1">
            <div class="row m-3">
                <div class="col col-auto">
                    <label for="" class="form-label">単語検索：</label>
                    <input type="text" name="searchWord" value="{{ old('searchWord') }}" placeholder="書名・著者名を入力">
                </div>
            </div>
            <div class="row form-group m-3">
                <div class="col col-6">
                    <label for="" class="form-label">重要度：</label>
                    <select name="importance">
                        <option hidden></option>
                        <option></option>
                        @foreach($importance as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col col-6">
                    <label for="" class="form-label">状態：</label>
                    <select name="state" id="">
                    <option hidden></option>
                    <option></option>

                        @foreach($state as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-info">検索開始</button>
                <button onclick="location.href='/booknotes/home'" class="btn btn-secondary">検索条件クリア</button>
            </div>
        </div>
    </form>


    <!-- スマホ表示用　ここから -->
    <div id="sp-display" class="p-1">
    <p>全{{ $planedBooksCount->count() }}件</p>
        @foreach($planedBooks as $planedBook)
        <div class="card sp-note-index-a p-2 m-1">
            <div class="row">
                <div class="col col-5 one fs-5 fw-bold">
                    <a href="/planedbook/edit/{{ $planedBook->id }}">{{ $planedBook->planed_book_title }}</a>
                </div>
                <div class="col col-3.5 two fs-6">
                    {{ $planedBook->planed_book_importance }}
                </div>
                <div class="col col-3.5 two fs-6">
                    {{ $planedBook->created_at->format('Y/m/d') }}
                </div>
            </div>
            <div class="row">
                <div class="col col-6 three">
                    {{ $planedBook->planed_book_author }}
                </div>
                <div class="col col-4 four">
                    {{ $planedBook->planed_book_state }}
                </div>
                <div class="col col-2 five">
                    <form action="{{ route('planedBook.delete', $planedBook->id) }}" onSubmit="return checkDelete()" method="POST">
                        @csrf
                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm">削除</button>
                    </form>
                    
                </div>
            </div>
        </div>
        @endforeach

        <!-- ページネーション -->
        <div class="d-flex justify-content-center">
        {{ $planedBooks->appends(request()->input())->links() }}
        </div>
    </div>
    <!-- スマホ表示用　ここまで -->

    <!-- PC表示用　ここから -->
    <div id="pc-display" class="m-2">
        
        <table class="table table-striped">
            <p>全{{ $planedBooksCount->count() }}件</p>
            <thead class="table-dark">
                <tr>

                    <th class="col-1">作成日</th>
                    <th class="col-4.5">書名</th>
                    <th class="col-2.5">著者</th>
                    <th class="col-1">優先度</th>
                    <th class="col-2">状態</th>
                    <th class="col-1">削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planedBooks as $planedBook)
                <tr>
                    <td>{{ $planedBook->created_at->format('Y/m/d') }}</td>
                    <td><a href="/planedbook/edit/{{ $planedBook->id }}">{{ $planedBook->planed_book_title }}</a></td>
                    <td>{{ $planedBook->planed_book_author }}</td>
                    <td>{{ $planedBook->planed_book_importance }}</td>
                    <td>{{ $planedBook->planed_book_state }}</td>
                    <form action="{{ route('planedBook.delete', $planedBook->id) }}" onSubmit="return checkDelete()" method="POST">
                        @csrf
                        <td>
                            <button type="submit" name="delete" class="btn btn-outline-danger btn-sm">削除</button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- ページネーション -->
        <div class="d-flex justify-content-center">
        {{ $planedBooks->appends(request()->input())->links() }}
        </div>
        
    </div>
</div>

<!-- PC表示用　ここまで -->

<!-- 読書データ表示 -->


<script>

</script>


@endsection