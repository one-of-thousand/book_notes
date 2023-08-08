@extends('app.layouts.app')

@section('content')
<div class="container border-bottom border-3 p-3">
    <div class="row">
        <div class="col col-9">
            <div class="title fs-2">『幽霊』</div>
        </div>
        <div class="col col-3">
            <div class="favorite fs-3">97点</div>
        </div>
    </div>
    <div class="row">
        <div class="col col-9">
            <div class="author fs-5">北杜夫</div>
        </div>
        <div class="col col-3">
            <div class="favorite fs-3">
                <input type="checkbox" class="checkbox">
                <label class="btn"></label>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col col-6 d-grid gap-2 mx-auto">
            <div class="btn btn-outline-primary">登録内容を編集する</div>
        </div>
        <div class="col col-6 d-grid gap-2 mx-auto">
            <div class="btn btn-outline-danger">このNoteを削除する</div>
        </div>
    </div>
</div>


<div class="container p-3">
    <h2 class="text-center h3-designed">基本情報</h2>

    <!-- パソコン表示用　基本情報 -->
    <div class="container" id="pc-display">
        <table class="table">
            <thead>
                <tr class="table-primary">
                    <th scope="col" class="col col-2">出版社</th>
                    <th scope="col" class="col col-2">分類</th>
                    <th scope="col" class="col col-2">読書開始日</th>
                    <th scope="col" class="col col-2">読了日</th>
                    <th scope="col" class="col col-2">Note作成日</th>
                    <th scope="col" class="col col-2">Note更新日</th>
                </tr>
                <tr>
                    <td class="col col-2">新潮社</td>
                    <td class="col col-2">小説―文学</td>
                    <td class="col col-2">2023/7/1</td>
                    <td class="col col-2">2023/7/5</td>
                    <td class="col col-2">2023/7/10</td>
                    <td class="col col-2">2023/7/10</td>
                </tr>
            </thead>
        </table>
    </div>

    <!-- スマホ表示用―基本情報 -->
    <div class="container p-3" id="sp-display">
        <table class="table">
            <tr>
                <th>出版社</th>
                <td>新潮社</td>
            </tr>
            <tr>
                <th>分類</th>
                <td>小説―文学</td>
            </tr>
            <tr>
                <th>読書開始日</th>
                <td>2023/7/1</td>
            </tr>
            <tr>
                <th>読了日</th>
                <td>2023/7/5</td>
            </tr>
            <tr>
                <th>Note作成日</th>
                <td>2023/7/10</td>
            </tr>
            <tr>
                <th>Note更新日</th>
                <td>2023/7/10</td>
            </tr>
        </table>
    </div>


    <!-- 共通表示 -->
    <div class="container">
        <div class="card m-1">
            <div class="card-body">
                <div class="card-title fw-bold">概要・あらすじ</div>
                <p class="card-text">「人はなぜ追憶を語るのだろうか。どの民族にも神話があるように、どの個人にも心の神話があるものだ」昆虫採集に興ずる少年の心をふとよぎる幼い日に去った母親のイメージ、美しい少女に寄せる思慕…過去の希望と不安が、敗戦前後の高校生の胸に甦る。過去を見つめ、隠された幼児期の記憶を求めて深層意識の中に溯っていく。これは「心の神話」であり、魂のフィクションである。</p>
            </div>
        </div>
        <div class="card m-1">
            <div class="card-body">
                <div class="card-title fw-bold">感想</div>
                <p class="card-text">ダミーテキスト。ダミーテキスト。ダミーテキスト。ダミーテキスト。</p>
            </div>
        </div>
        <div class="card m-1">
            <div class="card-body fw-bold">
                <div class="card-title">メモ</div>
                <p class="card-title"></p>
            </div>
        </div>
    </div>

    <div class="container">
        <h2 class="text-center m-3 h3-designed">抜粋・シーン</h2>
        <div class="card m-1">
            <div class="card-body">
                <div class="row m-2">
                    <div class="col col-3 fw-bold">p16</div>
                    <div class="col col-3 fw-bold">冒頭文</div>
                    <div class="col col-3 fw-bold">文章技法</div>
                    <div class="col col-3 fw-bold"></div>
                </div>
                <div class="row m-2">
                　人は幼年期を、ごく単純なあどけない世界と考えがちだが、それは我々が逃れられぬ忘却という作用のためにほかならない。しかし、忘れるということの意味を、人は本当に考えてみたことがあるだろうか。なにか意味があって、人はそれらの心情を忘れさせるのではないだろうか。
　この物語は、むしろ忘却の生んだ物語である。すくなからぬ奇妙な発掘の結果なのだ。
                </div>
                <div class="row m-2">
                    <div class="col col-2 fw-bold">メモ</div>
                    <div class="col col-10">小説らしからぬ文章で始まる冒頭の数行に、すでに小説全体の雰囲気が決定されていて美しい。</div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection