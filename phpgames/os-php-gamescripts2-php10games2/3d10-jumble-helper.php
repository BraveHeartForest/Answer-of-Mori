<?php

/*
 * 3d10-jumble-helper.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

if (!empty($_POST)) {
    //$_POSTが空でないならば

    $words = explode("\n", file_get_contents('words.list.txt'));

    foreach ($words as $word) {
        $arr = str_split($word);
        //文字列を配列に変換する。第二引数が指定されていない場合は一文字ずつバラバラにする。
        sort($arr);
        //配列を昇順に並び替え。
        $key = implode('', $arr);
        //配列$arrを''で結合します。つまり間に何も挟みません。文字列に戻します。
        if (isset($lookup[$key])) {
            //$lookup[$key]が存在するならば
            array_push($lookup[$key], $word);
            //配列$lookup[$key]の最後に$wordを追加します。
        } else {
            $lookup[$key] = array($word);
            //$lookup[$key]が存在しないならば配列$wordを代入する。
            // var_dump($lookup[$key]);
        }
    }

    $arr = str_split($_POST['jumble']);
    //文字列を分解して配列に
    sort($arr);
    //配列を昇順に並び替え
    $search = implode('', $arr);
    //配列を結合して文字列に変換
    var_dump($search);
    
    if (isset($lookup[$search])) {
        //配列$lookupに$searchインデックスの要素が存在するならば
        foreach ($lookup[$search] as $word) {
            echo $word . "<br />";
        }
    }
}


?>
<p>物は試しでpostとでも入れてみると良い。或いはsample。</p>
<form method='post'>
<input name='jumble' />
<input type='submit' value='help' />
</form>