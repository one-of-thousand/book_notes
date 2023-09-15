@extends('app.layouts.app')
@section('title', 'タグ一覧')
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
            <th class="col-6">タグ名</th>
            <th class="col-2 text-center">付与数</th>
            <th class="col-2">編集</th>
            <th class="col-2">削除</th>
        </tr>
        @foreach($tags as $tag)
        <tr>
            <td>{{ $tag->tag_name }}</td>
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
        @endforeach
    </table>
</div>

@endsection