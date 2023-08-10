'use strict';

    //共通処理

//削除の確認
function checkDelete() {
    if(window.confirm('削除してよろしいですか')) {
        return true;
    } else {
        return false;
    }
}


    //ホーム画面のJS処理






    //note入力画面
//著者入力欄の増減処理
$(function () {
    const minCount = 1;
    const maxCount = 4;
    $('#author-plus').on('click', function () {
        let inputCount = $('#author-area .unit').length;
        if (inputCount < maxCount) {
            //要素のクローンを追加
            let element = $('#author-area .unit:last-child').clone(true);
            let inputList = element[0].querySelectorAll('input[type="text"]');
            for (let i = 0; i < inputList.length; i++) {
                inputList[i].value = "";
            }
            $('#author-area .unit').parent().append(element);
        }
    });
    $('.author-minus').on('click', function () {
        let inputCount = $('#author-area .unit').length;
        if (inputCount > minCount) {
            $(this).parents('.unit').remove();
        }
    });
});

//抜粋文フォームの追加・削除処
$(function () {
    $('#sentence-add').on('click', function () {
        let inputCount = $('#sentence-area .unit').length;
        //要素のクローンを追加
        let element = $('#sentence-area .unit:last-child').clone(true);

        let inputList = element[0].querySelectorAll('input[type="text"], textarea, select');
        for (let i = 0; i < inputList.length; i++) {
            inputList[i].value = "";
        }
        $('#sentence-area .unit').parent().append(element);


        //最下部にスクロール
        let elm = document.documentElement;

        //ページの最下部位置を保存
        let bottom = elm.scrollHeight - elm.clientHeight;

        //垂直方向に移動
        window.scroll(0, bottom);
    }
    );

    //削除ボタンを押したときの処理
    $('#sentence-delete').on('click', function () {
        let inputCount = $('#sentence-area .unit').length;
        if (inputCount > 1) {
            $(this).parents('.unit').remove();
        }
        
        let elm = document.documentElement;

        //ページの最下部位置を保存
        let bottom = elm.scrollHeight - elm.clientHeight;

        //垂直方向に移動
        window.scroll(0, bottom);

    });
});




/**
 * 評価のスライダー値をリアルタイムで表示
 */
window.onload = function () {

    const inputElem = document.getElementById("range");
    //値の埋め込み先要素を取得
    const currentValue = document.getElementById('current-score');

    //現在の値を埋め込む関数
    const setCurrentValue = (val) => {
        currentValue.innerText = val;
    }

    //inputイベント時に値をセットする関数
    const rangeOnChange = (e) => {
        setCurrentValue(e.target.value);
    }

    //値の変更に合わせてイベントを発火する
    inputElem.addEventListener('input', rangeOnChange);
    //ページ読み込み時の値をセット
    setCurrentValue(inputElem.value);
}



