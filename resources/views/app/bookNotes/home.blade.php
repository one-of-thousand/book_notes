@extends('app.layouts.app')

@section('content')
<!-- 共通 -->
<div id="reading-data" class="container">
    <h2 class="text-center h2-designed">これまでの読書データ</h2>
    <table class="table table-bordered">
        <tr>
            <th class="col-4">Note総登録数</th>
            <th class="col-4">抜粋総登録数</th>
            <th class="col-4">6月のNote登録数</th>
        </tr>
        <tr>
            <td class="col-4">100件</td>
            <td class="col-4">200文</td>
            <td class="col-4">10件</td>
        </tr>
    </table>
</div>

<div class="container p-2">
    <h2 class="text-center h2-designed">読みたい本リスト</h2>
    <a href="{{ route('planedBook.create') }}"><div class="btn btn-primary m-2" id="">リストに追加</div></a>


    <!-- スマホ表示用　ここから -->
    <div id="sp-display" class="p-3">
        <div class="card sp-note-index-a p-2 m-1">
            <div class="row">
                <div class="col col-9 one fs-5 fw-bold">
                    <a href="">アヒルと鴨のコインロッカー</a>
                </div>
                <div class="col col-3 two fs-6">
                    ★★★★★
                </div>
            </div>
            <div class="row">
                <div class="col col-6 three">
                    伊坂幸太郎
                </div>
                <div class="col col-4 four">
                    入手済み
                </div>
                <div class="col col-2 five">
                    <form action="" method="post">
                        <input type="submit" name="delete" class="btn btn-outline-danger btn-sm" value="削除">

                        <!-- <input type="hidden" th:value="${book.id}" name="id">
                    <input type="hidden" th:value="${book.version}" name="version"> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="card sp-note-index-a p-2 m-1">
            <div class="row">
                <div class="col col-9 one fs-5 fw-bold">
                    <a href="">幽霊</a>
                </div>
                <div class="col col-3 two fs-6">
                    ★★★
                </div>
            </div>
            <div class="row">
                <div class="col col-6 three">
                    北杜夫
                </div>
                <div class="col col-4 four">
                    積ん読
                </div>
                <div class="col col-2 five">
                    <form action="" method="post">
                        <input type="submit" name="delete" class="btn btn-outline-danger btn-sm" value="削除">

                        <!-- <input type="hidden" th:value="${book.id}" name="id">
                    <input type="hidden" th:value="${book.version}" name="version"> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- スマホ表示用　ここまで -->

    <!-- PC表示用　ここから -->
    <div id="pc-display" class="m-2">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>

                    <th class="col-5">書名</th>
                    <th class="col-3">著者</th>
                    <th class="col-1">優先度</th>
                    <th class="col-2">状態</th>
                    <th class="col-1">削除</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <!-- todo -->
                    <td><a>アヒルと鴨のコインロッカー</a></td>
                    <td>伊坂幸太郎</td>
                    <td>★★★★★</td>
                    <td>入手済み</td>
                    <td>
                        <form action="" method="post">
                            <input type="submit" name="delete" class="btn btn-outline-danger btn-sm" value="削除">

                            <!-- <input type="hidden" th:value="${book.id}" name="id">
                        <input type="hidden" th:value="${book.version}" name="version"> -->
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- PC表示用　ここまで -->

<!-- 読書データ表示 -->
<div class="container">
    <h2 class="h2-designed text-center">読書データ一覧</h2>
</div>



@endsection