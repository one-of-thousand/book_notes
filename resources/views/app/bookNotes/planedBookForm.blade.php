@extends('app.layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center h1-designed">読みたい本リストを追加</h1>

    <form action="#">
        <div class="form-group mb-3">
            <label class="form-label">書名</label>
            <input type="text" name="title" class="form-control" placeholder="例）吾輩は猫である">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">著者名</label>
            <input type="text" name="title" class="form-control" placeholder="例）夏目漱石">
        </div>
        <div class="form-group mb-3">
            <label class="form-label">重要度</label>
            <input type="text" name="title" class="form-control" placeholder="例）夏目漱石">
        </div>
        <div class="form-group row mb-3">
                <div class="col">
                    <label class="form-label">重要度を選択</label>
                    <select class="form-select" name="big-genre">
                        <option>★</option>
                        <option>★★</option>
                        <option>★★★</option>
                        <option>★★★★</option>
                        <option>★★★★★</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">状態を選択</label>
                    <select class="form-select" name="small-genre">
                        <option>気になる</option>
                        <option>手続き中</option>
                        <option>入手済み</option>
                        <option>積ん読</option>
                        <option>読書中</option>
                    </select>
                </div>
            </div>
    </form>
</div>

@endsection