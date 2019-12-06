<?php

/*
 * 3d10-crossword-helper.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

if (!empty($_POST)) {

    $words = explode("\n", file_get_contents('words.list.txt'));
    //words.list.txtを文字列として取得して、改行記号で分解して配列に変換。

    $matches = array();
    foreach ($words as $word) {
        if (preg_match("/^" . $_POST['guess'] . "$/",$word)) {
            //$wordが$_POST['guess']で始まり且つ終わる、にマッチする。
            //これでは完全一致以外に存在しないのでは？
            echo $word . "<br />\n";
        }
    }
}


?>
<form method='post'>
<input name='guess' />
<input type='submit' value='help' />
</form>