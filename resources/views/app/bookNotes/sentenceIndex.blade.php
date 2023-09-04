@extends('app.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center h1-designed">抜粋・シーン一覧</h1>
    <form action="">
        <div class="form-group">
            <label class="form-label">単語検索：</label>
            <input type="text" name="search-word">
        </div>
    </form>
    <div class="text-center">
        <a href="{{ route('tag.index') }}">タグを編集する</a>
    </div>
    @if (session('err_msg'))
    <p class="text-danger">
        {{ session('err_msg') }}
    </p>
    @endif
</div>


<!-- スマホ用の一覧テーブル -->
<div class="container" id="sp-display">
<p>全 {{ $sentenceCount->count() }} 件</p>
    @foreach($sentences as $sentence)
    <div class="card sp-display-a m-1 p-2">
    
        <div class="row">
            <div class="col col-7 one fs-5 fw-bold">
                <a href="/note/detail/{{ $sentence->note_id }}">
                    {{ $sentence->note->note_title }}
                </a>
            </div>
            <div class="col col-5 two fs-6">
                【{{ $sentence->tag->tag_name }}】
            </div>
            

        </div>
        <div class="row">
            <div class="col col-12">
                <a href="/sentence/detail/{{ $sentence->id }}" style="text-decoration: none; color: inherit;">
                    {!! nl2br(htmlspecialchars($sentence->sentence_body)) !!}
                </a>
            </div>
        </div>
        <div class="border mt-4 ms-4 me-4 p-2">
            @if(isset($sentence->sentence_memo))
            メモ：{{ $sentence->sentence_memo }}
            @else
            メモ：なし
            @endif
        </div>
    
    </div>
    @endforeach
    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $sentences->appends(request()->input())->links() }}
        </div>
</div>


<!-- パソコン用の一覧テーブル -->
<div class="container" id="pc-display">
    <p>全 {{ $sentenceCount->count() }} 件</p>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th class="col col-2">書名</th>
                <th class="col col-6">内容</th>
                <th class="col col-1">タグ</th>
                <th class="col col-2">メモ</th>
                <th class="col col-1">編集</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sentences as $sentence)
        
            <tr>
            
                <td><a href="/note/detail/{{ $sentence->note_id }}">{{ $sentence->note->note_title }}</a></td>
                <td>
                    <a href="/sentence/detail/{{ $sentence->id }}" class="m-1 p-2 sp-display-a">
                        <!-- {!! Str::limit(nl2br(htmlspecialchars($sentence->sentence_body)), 100, '...') !!} -->
                        {!! nl2br(htmlspecialchars($sentence->sentence_body)) !!}
                    </a>
                </td>
                <td>{{ $sentence->tag->tag_name }}</td>
                <td>
                @if(isset($sentence->sentence_memo))
                    {{ $sentence->sentence_memo }}
                @else
                    なし
                @endif
                </td>
                <td>
                <a href="/sentence/edit/{{ $sentence->id }}" class="btn btn-outline-primary btn-sm">↗</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    
    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{ $sentences->appends(request()->input())->links() }}
        </div>
</div>
@endsection