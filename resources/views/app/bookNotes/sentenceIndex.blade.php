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
</div>

<!-- スマホ用の一覧テーブル -->
<div class="container" id="sp-display">
    <a href="" div class="card sp-display-a m-1 p-2">
        <div class="row">

            <div class="col col-6 one fs-5 fw-bold">
                アヒルと鴨のコインロッカー
            </div>
            <div class="col col-5 two fs-6">
                冒頭文、比喩表現、格言
            </div>
            <div class="col col-1">
                ★
            </div>

        </div>
        <div class="row">
            <div class="col col-12">
                ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。
            </div>
        </div>
    </a>
    <a href="" div class="card sp-display-a m-1 p-2">
        <div class="row">

            <div class="col col-6 one fs-5 fw-bold">
                幽霊
            </div>
            <div class="col col-5 two fs-6">
                冒頭文、比喩表現、格言
            </div>
            <div class="col col-1">
                ★
            </div>

        </div>
        <div class="row">
            <div class="col col-12">
                ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。
            </div>
        </div>
    </a>
</div>


<!-- パソコン用の一覧テーブル -->
<div class="container" id="pc-display">
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th class="col-0.5"></th>
                <th class="col-3">書名</th>
                <th class="col-5">内容</th>
                <th class="col-2.5">タグ</th>
                <th class="col-1">編集</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- todo -->
                <td>★</td>
                <td><a href="">アヒルと鴨のコインロッカー</a></td>
                <td>ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</td>
                <td>冒頭文、比喩表現、表現技法</td>
                <td>
                    <a href="#" class="btn btn-outline-primary btn-sm">↗</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection