@extends('app.layouts.app')
@section('title', '文章編集画面')

@section('content')
<div class="container">
    <h2 class="m-1 border-bottom border-dark pb-2">『{{ $sentence->note->note_title }}』より</h2>
    <form method="POST" action="{{ route('sentence.update') }}" onsubmit="return checkSubmit()">
    @csrf
        <input type="hidden" name="sentence_id" value="{{ $sentence->id }}">
        <div class="form-group row">
            <div class="col-3 mb-3">
                <label class="form-label">ページ数</label>
                <input type="text" class="form-control" name="sentence_page" value="{{ $sentence->sentence_page }}">
            </div>
            <div class="col-3 mb-3">
                <label class="form-label">タグ</label>
                <select class="form-select" name="tag_id" id="tag_select">
                    @foreach($tags as $key => $value)
                    <option value="{{ $key }}" {{ $sentence->tag_id == $key? 'selected': ''}}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="form-group">
            <div class="form-group mb-3">
                <label class="form-label">抜粋・シーン</label>
                <textarea class="form-control" name="sentence_body" rows="8">{{ $sentence->sentence_body }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">コメント</label>
                <textarea class="form-control" name="sentence_memo" rows="2">{{ $sentence->sentence_memo }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col col-12 text-center">
                <a href="{{ route('sentence.index') }}" class="btn btn-secondary">キャンセル</a>
                <button type="submit" name="submit" class="btn btn-primary">更新する</button>
            </div>
        </div>
    </form>
</div>

<script>
//更新の確認
function checkSubmit() {
    if(window.confirm('更新してよろしいですか')) {
        return true;
    } else {
        return false;
    }
}
</script>
@endsection