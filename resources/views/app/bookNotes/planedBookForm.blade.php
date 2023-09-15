@extends('app.layouts.app')
@section('title', '読みたい本新規登録')
@section('content')
<div class="container">
    <h1 class="text-center h1-designed">読みたい本リストを追加</h1>

    <form method="POST" action="{{ route('planedBook.store') }}">
    @csrf
        <!-- ログイン中のユーザーidをコントローラーに渡す -->
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        
        <div class="form-group mb-3">
            <label class="form-label">書名</label>
            <input type="text" name="planed_book_title" value="{{ old('planed_book_title') }}" class="form-control" placeholder="例）吾輩は猫である">
            @if ($errors->has('planed_book_title'))
                <div class="text-danger">
                    {{ $errors->first('planed_book_title') }}
                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <label class="form-label">著者名</label>
            <input type="text" name="planed_book_author" value="{{ old('planed_book_author') }}" class="form-control" placeholder="例）夏目漱石">
            @if ($errors->has('planed_book_author'))
                <div class="text-danger">
                    {{ $errors->first('planed_book_author') }}
                </div>
            @endif
        </div>

        <div class="form-group row mb-3">
            <div class="col">
                <label class="form-label">重要度を選択</label>
                <select type="text" class="form-select" name="planed_book_importance">
                    @foreach($importance as $key => $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col">
                <label class="form-label">状態を選択</label>
                <select type="text" class="form-select" name="planed_book_state">
                    @foreach($state as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col col-6 d-grid gap-2 mx-auto">
                <a href="{{ route('note.home') }}" class="btn btn-secondary btn-block btn-lg">キャンセル</a>
            </div>
            <div class="col col-6 d-grid gap-2 mx-auto">
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="リストに追加">
            </div>
        </div>
    </form>
</div>

@endsection