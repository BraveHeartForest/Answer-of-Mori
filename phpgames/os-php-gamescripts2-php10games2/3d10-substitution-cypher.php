<?php

/*
 * 3d10-substitution-cyphers.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$code = $letters;
//$codeは$lettersをコピーしたもの。
shuffle($code);
//シャッフル
$key = array_combine($letters, $code);
//$keyは$lettersをキーとして持ち、$codeを値として持つ連想配列です。

if (!empty($_POST)) {
    //$_POSTが空でないならば、
    $messageletters = str_split(strtolower($_POST['message']));
    //$_POST['message']を全て小文字に変換し、一文字ずつ分解して配列に変換。
    $show = $_POST['message']."=>";
    //文字列を初期化
    foreach ($messageletters as $letter) {
        $show .= $key[$letter];
    }
    $showkey = '';
    foreach ($key as $letter=>$decode) {
        $showkey .= $letter . " = " . $decode . " <br>";
    }
}

?>
Message : <?php echo @$show ?><br />
Key : <?php echo @$showkey ?><br />
<form method='post'>
<input name='message' />
<input type='submit' value='encode' />
</form>
<a href='3d10-substitution-cypher.php'>Start Over</a><br />