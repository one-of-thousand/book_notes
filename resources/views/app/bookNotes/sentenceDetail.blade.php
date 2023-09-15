@extends('app.layouts.app')
@section('title', '文章編集')

@section('content')
<div class="container">
    <h2 class="m-1 border-bottom border-dark pb-2">『{{ $sentence->note->note_title }}』より</h2>

    <div class="row m-1">
        <div class="col col-2">
            p. {{ $sentence->sentence_page }}
        </div>
        <div class="col col-auto">
            【 {{ $sentence->tag->tag_name }} 】
        </div>
        <div class="m-1">
            メモ：{{ $sentence->sentence_memo }}
        </div>
        <div class="m-1 bg-light p-2">
            {!! nl2br(htmlspecialchars($sentence->sentence_body)) !!}
        </div>
    </div>

    <div class="row">
        <div class="col col-6 d-grid gap-2 mx-auto">
            <a href="/sentence/edit/{{ $sentence->id }}" class="btn btn-outline-primary">編集する</a>
        </div>
        <form action="{{ route('sentence.delete', $sentence->id) }}" method="post" class="col col-6 d-grid gap-2 mx-auto" onsubmit="return checkDelete()" >
            @csrf
            <input type="submit" name="delete" class="btn btn-outline-danger" value="削除" onclick=>
        </form>
        
    </div>
    </form>
</div>
<script>
    //削除の確認
    function checkDelete() {
        if(window.confirm('削除してよろしいですか')) {
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection