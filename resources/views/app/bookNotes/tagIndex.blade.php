@extends('app.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center h1-designed">タグ編集</h1>

    <form action="">
        <div class="row">
            <div class="col col-auto">
                タグを追加：
            </div>
            <div class="col">
                <input type="text" name="tagName" class="form-control" placeholder="タグ名を入力">
            </div>
            <div class="col">
            <div class="btn btn-primary" type="submit">決定</div>
            </div>
        </div>
    </form>
</div>

<div class="container">
    <table class="table">
        <tr class="table-primary">
            <th class="col-1">No.</th>
            <th class="col-5">タグ名</th>
            <th class="col-2 text-center">付与数</th>
            <th class="col-1.5">編集</th>
            <th class="col-1.5">削除</th>
        </tr>
        <tr>
            <td>1</td>
            <td>冒頭文</td>
            <td class="text-center">2</td>
            <td><a href="#" class="btn btn-outline-primary btn-sm">↗</a></td>
            <td>
                <form action="" method="post">
                    <input type="submit" name="delete" class="btn btn-outline-danger btn-sm" value="×">

                    <!-- <input type="hidden" th:value="${book.id}" name="id">
                            <input type="hidden" th:value="${book.version}" name="version"> -->
                </form>
            </td>
        </tr>
    </table>
</div>

@endsection