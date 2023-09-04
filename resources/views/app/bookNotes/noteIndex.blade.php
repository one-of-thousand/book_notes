@extends('app.layouts.app')

@section('content')


<div class="container">
    <h1 class="text-center h1-designed">Note一覧</h1>
    <form action="">
        <div class="form-group">
            <label class="form-label">単語検索：</label>
            <input type="text" name="search-word">
        </div>
    </form>
</div>

<!-- スマホ表示用 -->
<div class="container" id="sp-display">
<p>全{{ $notesCount->count() }}件</p>
    
        @foreach($notes as $note)
        <a href="/note/detail/{{ $note->id }}" class="card sp-display-a m-1 p-2">
        <div class="row">
            <div class="col col-12 fs-4">
                {{ $note->note_title }}
            </div>
            
        </div>
        <div class="row">
            <div class="col col-6 three">
                @foreach($note->authors as $author)
                    {{ $author->author_name }}
                @endforeach
            </div>
            <div class="col col-2 four">
                {{ $note->note_score }}
            </div>
            <div class="col col-4">
                登録：{{ $note->created_at->format('Y/m/d') }}
            </div>
        </div>
        </a>
        @endforeach
    
    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $notes->appends(request()->input())->links() }}
        </div>
</div>


<!-- パソコン表示用 -->
<div class="container" id="pc-display">
    <table class="table table-striped">
    <p>全{{ $notesCount->count() }}件</p>
        <thead class="table-dark">
            <tr>

                <th class="col-4">書名</th>
                <th class="col-3">著者</th>
                <th class="col-2">Note登録日</th>
                <th class="col-1">評価</th>
                <th class="col-1">編集</th>
                <th class="col-1">削除</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            <tr>
                <td><a href="/note/detail/{{ $note->id }}">{{ $note->note_title }}</a></td>
                <td>
                    @foreach($note->authors as $author)
                        {{ $author->author_name }}
                    @endforeach
                </td>
                <td>{{ $note->created_at->format('Y/m/d') }}</td>
                <td>{{ $note->note_score }}</td>
                <td>
                    <a href="/note/edit/{{ $note->id }}" class="btn btn-outline-primary btn-sm">↗</a>
                </td>
                <td>
                    <form action="{{ route('note.detail', $note->id)}}" method="post">
                        <input type="submit" name="delete" class="btn btn-outline-danger btn-sm" value="×">

                        <!-- <input type="hidden" th:value="${book.id}" name="id">
                            <input type="hidden" th:value="${book.version}" name="version"> -->
                    </form>
                    
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $notes->appends(request()->input())->links() }}
        </div>
</div>
@endsection