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
    <a href="" div class="card sp-display-a m-1 p-2">
        <div class="row">
            <div class="col col-11 fs-4">
                アヒルと鴨のコインロッカー
            </div>
            <div class="col col-1">
                ★
            </div>
        </div>
        <div class="row">
            <div class="col col-6 three">
                伊坂幸太郎
            </div>
            <div class="col col-2 four">
                85点
            </div>
            <div class="col col-4">
                登録：2023/07/30
            </div>
        </div>
    </a>
    <a href="" div class="card sp-display-a m-1 p-2">
        <div class="row">
            <div class="col col-11 fs-4">
                幽霊
            </div>
            <div class="col col-1">
                ★
            </div>
        </div>
        <div class="row">
            <div class="col col-6 three">
                北杜夫
            </div>
            <div class="col col-2 four">
                95点
            </div>
            <div class="col col-4">
                登録：2023/07/25
            </div>
        </div>
    </a>
</div>


<!-- パソコン表示用 -->
<div class="container" id="pc-display">
    <table class="table table-striped">
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

            <tr>
                <!-- todo -->
                <td><a href="">アヒルと鴨のコインロッカー</a></td>
                <td>伊坂幸太郎</td>
                <td>23/07/19</td>
                <td>88点</td>
                <td>
                    <a href="#" class="btn btn-outline-primary btn-sm">↗</a>
                </td>
                <td>
                    <form action="" method="post">
                        <input type="submit" name="delete" class="btn btn-outline-danger btn-sm" value="×">

                        <!-- <input type="hidden" th:value="${book.id}" name="id">
                            <input type="hidden" th:value="${book.version}" name="version"> -->
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection