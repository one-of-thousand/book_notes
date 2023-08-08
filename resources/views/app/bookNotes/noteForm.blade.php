@extends('app.layouts.app')

@section('content')
<div class="container">
    <form>
        <div class="text-right">
            <button type="submit" name="submit" class="btn btn-primary">登録する</button>
            <button type="submit" name="draft" class="btn btn-info">下書き保存</button>
            <button name="note_favorite" class="btn btn-warning">お気に入り</button>
        </div>
        <h2>基本情報</h2>
        <div class="">
            <div class="form-group mb-3">
                <label class="form-label">書名</label>
                <input type="text" name="title" class="form-control" placeholder="例）吾輩は猫である">
            </div>

            <label class="form-label">著者</label>
            <div id="author-plus" class="btn btn-primary btn-sm">著者を追加</div>
            <div id="author-area" class="form-group">
                <div class="unit input-group mb-2">
                    <input name="test[]" type="text" class="form-control" placeholder="例）夏目漱石">
                    <div class="author-minus input-group-append">
                        <span class="btn btn-danger">-</span>
                    </div>
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">出版社</label>
                    <input type="text" name="publisher" class="form-control" placeholder="例）新潮社">
                </div>
                <div class="col">
                    <label for="customRange1" class="form-label">評価 : <span><span id="current-score"></span>点</span></label><br>
                    <input class="input-range" type="range" name="score" id="range" min="0" max="100" value="50">
                </div>
            </div>
            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">読書開始</label>
                    <input type="date" class="form-control" name="start-reading">
                </div>
                <div class="col">
                    <label class="form-label">読書終了</label>
                    <input type="date" class="form-control" name="end-reading">
                </div>
            </div>

            <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">分類1を選択</label>
                    <select class="form-select" name="big-genre">
                        <option>小説</option>
                        <option>新書</option>
                        <option>雑誌</option>
                        <option>営業本部</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">分類2を選択</label>
                    <select class="form-select" name="small-genre">
                        <option>小説</option>
                        <option>SEOマーケティング部</option>
                        <option>人事・総務部</option>
                        <option>営業本部</option>
                    </select>
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">概要・あらすじ</label>
                <textarea class="form-control" name="outline" rows="3"></textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">感想</label>
                <textarea class="form-control" name="impression" rows="3"></textarea>
            </div>
            <div class="form-group mb-3">
                <label class="form-label">メモ</label>
                <textarea class="form-control" name="memo" rows="3"></textarea>
            </div>
        </div>

        <h2>抜粋・シーンを記録</h2>

        

        <div class="form-group" id="sentence-area">
            <div class="unit">
                <div class="card bg-light" style="margin-bottom: 2em; padding: 1em">
                    <div class="form-group row">
                        <div class="col-3 mb-3">
                            <label class="form-label">ページ数</label>
                            <input type="text" class="form-control" name="page[]">
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">タグ1</label>
                            <select class="form-select" name="tags[]">
                                <option>冒頭文</option>
                                <option>末尾文</option>
                                <option>比喩表現</option>
                                <option>心情描写</option>
                            </select>
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">タグ2</label>
                            <select class="form-select" name="tags[]">
                                <option>冒頭文</option>
                                <option>末尾文</option>
                                <option>比喩表現</option>
                                <option>心情描写</option>
                            </select>
                        </div>
                        <div class="col-3 mb-3">
                            <label class="form-label">タグ3</label>
                            <select class="form-select" name="tags[]">
                                <option>冒頭文</option>
                                <option>末尾文</option>
                                <option>比喩表現</option>
                                <option>心情描写</option>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="form-group mb-3">
                            <label class="form-label">抜粋・シーン</label>
                            <textarea class="form-control" name="sentence[]" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">コメント</label>
                            <textarea class="form-control" name="comment[]" rows="1"></textarea>
                        </div>
                        <div class="text-center">
                            <span id="sentence-num"></span>
                            <span class="btn btn-danger" id="sentence-delete" style="margin-bottom: 1.em">削除</span>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="btn btn-primary" id="sentence-add">抜粋フォームを追加</div>

    </form>
</div>
@endsection