@extends('app.layouts.app')

@section('content')
<div class="container border-bottom border-3 p-3">
    <div class="row">
        <div class="col col-9">
            <div class="title fs-2">{{ $note->note_title }}</div>
        </div>
        <div class="col col-3">
            <div class="favorite fs-3">{{ $note->note_score }}点</div>
        </div>
    </div>
    <div class="row">
        @foreach($authors as $author)
        <div class="col col-auto">
            <div class="author fs-5">{{ $author->author_name }}</div>
        </div>
        @endforeach
        
    </div>
    <div class="row">
        <div class="col col-6 d-grid gap-2 mx-auto">
            <a href="/note/edit/{{ $note->id }}" class="btn btn-outline-primary">登録内容を編集する</a>
        </div>
        <div class="col col-6 d-grid gap-2 mx-auto">
            <form action="/note/delete/{{ $note->id }}" onsubmit="return checkDelete()" method="POST">
            @csrf
                <input type="submit" name="delete" class="btn btn-outline-danger" value="このNoteを削除する" onclick=>
            </form>
        </div>
    </div>
</div>


<div class="container p-3">
    <div class="mt-2 mb-4">
    <h2 class="text-center h3-designed">基本情報</h2>
    </div>
    <!-- パソコン表示用　基本情報 -->
    <div class="container" id="pc-display">
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th scope="col" class="col col-1.5">出版社</th>
                    <th scope="col" class="col col-2.5">分類</th>
                    <th scope="col" class="col col-2">読書開始日</th>
                    <th scope="col" class="col col-2">読了日</th>
                    <th scope="col" class="col col-2">Note作成日</th>
                    <th scope="col" class="col col-2">Note更新日</th>
                </tr>
                <tr>
                    <td class="col col-1.5">{{ $note->note_publisher }}</td>
                    <td class="col col-2.5">{{ $note->bigGenre->big_genre_name }} ― {{ $note->smallGenre->small_genre_name }}</td>
                    <td class="col col-2">{{ $note->note_start_reading }}</td>
                    <td class="col col-2">{{ $note->note_end_reading }}</td>
                    <td class="col col-2">{{ $note->created_at->format('Y/m/d') }}</td>
                    <td class="col col-2">{{ $note->updated_at->format('Y/m/d') }}</td>
                </tr>
            </thead>
        </table>
    </div>

    <!-- スマホ表示用―基本情報 -->
    <div class="container p-3" id="sp-display">
        <table class="table">
            <tr>
                <th>出版社</th>
                <td>{{ $note->note_publisher }}</td>
            </tr>
            <tr>
                <th>分類</th>
                <td>{{ $note->bigGenre->big_genre_name }} ― {{ $note->smallGenre->small_genre_name }}</td>
            </tr>
            <tr>
                <th>読書開始日</th>
                <td>{{ $note->note_start_reading }}</td>
            </tr>
            <tr>
                <th>読了日</th>
                <td>{{ $note->note_end_reading }}</td>
            </tr>
            <tr>
                <th>Note作成日</th>
                <td>{{ $note->created_at->format('Y/m/d') }}</td>
            </tr>
            <tr>
                <th>Note更新日</th>
                <td>{{ $note->updated_at->format('Y/m/d') }}</td>
            </tr>
        </table>
    </div>


    <!-- 共通表示 -->
    <div class="container">
        <div class="card m-1">
            <div class="card-body">
                <div class="card-title fw-bold">概要・あらすじ</div>
                <p class="card-text">{{ $note->note_outline }}</p>
            </div>
        </div>
        <div class="card m-1">
            <div class="card-body">
                <div class="card-title fw-bold">感想</div>
                <p class="card-text">{{ $note->note_impression }}</p>
            </div>
        </div>
        <div class="card m-1">
            <div class="card-body fw-bold">
                <div class="card-title">メモ</div>
                <p class="card-title">{{ $note->note_memo }}</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="mt-4 mb-4">
        <h2 class="text-center m-2 h3-designed">抜粋文章</h2>
        </div>
        @foreach($sentences as $sentence)
        <div class="card m-1 mb-2">
            <div class="card-body">
                <div class="row m-2">
                    <div class="col col-3 fw-bold border-bottom">p. {{ $sentence->sentence_page }}</div>
                    <div class="col col-9 fw-bold border-bottom">【 {{ $sentence->tag->tag_name }} 】</div>
                </div>
                <div class="row mt-4 mb-4 ms-2 me-2">{!! nl2br(htmlspecialchars($sentence->sentence_body)) !!}</div>
                <div class="row m-2">
                    <div class="col col-9 fw-bold">メモ</div>
                    <div class="col col-10">
                    @if(isset($sentence->sentence_memo))
                        {{ $sentence->sentence_memo }}
                    @else
                        なし
                    @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
//更新の確認
function checkDelete() {
    if(window.confirm('削除してよろしいですか')) {
        return true;
    } else {
        return false;
    }
}
</script>

@endsection