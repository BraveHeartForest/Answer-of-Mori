'use strict';

$(function () {
    const $username = $('#username');   //固定値
    const $password = $('#password');
    const $agreement = $('#agreement');
    const $submit = $('#submit');

    // フォームチェック関数
    function isFormValid() {
        const isValid = $username.val().trim()
            && $password.val().trim()
            && $agreement.prop('checked');
            //結果的にはisValidはT/Fで表される。???.val().trim()は文字列ではないのか？ 何故それで真偽値が返ってくるのか納得できない。
        //???.val().trim()で取得した値に含まれる半角スペースを取り除く。
        //trim関数はjsの持つ標準APIの一つ。文字列の両側のスペースを取り除く。
        //jQueryでチェックボックスのチェック状態を取得するためには、チェックボックスのjQueryオブジェクト（今回は$agreement)に対して、prop関数でchecked属性を参照します。
        //propと類似した関数でattrがありますが、checkedやdisabledなどの真偽値(trueかfalseの値)を持つ属性はpropを利用します。

        $submit.attr("disabled", !isValid);
    }

    // ページロード時にチェックを行う
    isFormValid();

    // フォームコントロールのイベントハンドラ
    $('input').on('keyup change', function () {
        //keyupを使うことで「何か文字をタイプしてキーを離した直後のイベント」を検知。
        //keydown,keypressの場合は"変更が発生する前"のイベント。∴入力した文字は取得不可。
        //チェックボックスのチェック状態の変更を検知するためには、changeイベントを利用します。
        isFormValid();
    });

    // フォームが送信された時にアラートを表示する
    $('form').on('submit', (e) => {
        e.preventDefault();
        // 本当はこの部分に実際の登録処理を書く
        alert('登録しました。');
        /*alert($username.val().trim()
            && $password.val().trim()
            && $agreement.prop('checked'));*/
});
});