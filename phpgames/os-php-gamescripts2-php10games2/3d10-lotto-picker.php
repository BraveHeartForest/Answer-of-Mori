<?php

/*
 * 3d10-lotto-picker.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$picks = explode("\n", file_get_contents("lotto.won.txt"));
//lotto.won.txtの内容を文字列として取得して、改行で区切り配列に変換。

if (!empty($_POST)) {
    //$_POSTの空でないならば
    $pick = explode(",", $_POST['pick']);
    //$_POST['pick']の内容を","で分割して配列に変換。
    if (count($pick) == 6) {
        //配列$pickの要素数が6ならば
        $picks[] = $_POST['pick'];
        file_put_contents("lotto.won.txt", implode("\n", $picks) );
        //lotto.won.txtにimplode(...)の内容を書き込む。
        //implode(...)は配列$picksの要素を"\n"で繋ぎ結合する。
    }
}

$numbers = array_fill(1,40,0);
//$numbers : Array([1]=>0 ,..., [40]=>0)になる。

foreach ($picks as $pick) {
    $pick = explode(",", $pick);
    //$pickを","で区切り配列に変換。
    foreach ($pick as $number) {
        //$pickの要素である$numberに対応する$numbersの要素を+1する。
        $numbers[$number]++;
    }
}

asort($numbers);
//連想キーと要素との関係を維持しつつ、要素の昇順に並べ替えます。
//因みに逆順はarsort()です。

$pick = array_slice($numbers,0,6,true);
//配列$numbersの0番目から6個取り出します。trueを付けないと配列の番号が振り直されます。

echo implode(',',array_keys($pick)) . "\n";
//array_keys($pick)で配列$pickからすべてのキーを返します。この型はArrayです。
//それを","で繋いで文字列に変換したものを表示する。

?>
<form method='post'>
<input name='pick' />
<input type='submit' value='enter a winning pick' />
</form>