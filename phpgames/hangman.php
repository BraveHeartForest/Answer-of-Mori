<?php
$words = explode('\n',file_get_contents('hangman.word.txt'));     //explode:文字列を文字列により分割する
//file_get_contents:ファイルの内容を全て文字列に読み込む


//リスト17
$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o',
'p','q','r','s','t','u','v','w','x','y','z');
$right = array_fill_keys($letters, '.');    //array_...keys($keys,$value)はvalueで指定した値で配列を埋めます。キーとして$keyで指定した配列を用います。
//今回の場合は$right: Array([a]=>'.' ,..., [z]=>'.')となる。
// var_dump($right);
$wrong = array();   //初期化、外れを保持する配列の予定。

$word = 'word';
$guess = 'e';

//リスト18
if (stristr($word, $guess)) {
    //stristr(string $haystack, mixed $needle [,bool $before_needle = FALSE]) : string :大文字小文字を区別しない。
    //haystackにおいてneedleが最初に見つかった位置を含めてそこから最後までを返します。
    // $email = 'USER@EXAMPLE.com';
    // echo stristr($email, 'e'); // 出力は ER@EXAMPLE.com となります
    // echo stristr($email, 'e', true); // PHP 5.3.0 以降では、出力は US となります

    //hangmanというゲームの仕様上、$wordは単語、$guessは一文字であるべき。

    $show = ''; //文字列の初期化
    $right[$guess] = $guess;    //$guessがeならば$right[e]=eとなり、$right : Array([a]=>'.', ..., [e]=>'e', ...,[z]=>'.')
    $wordletters = str_split($word);    //文字列を配列に変換。第二引数が無記入ならば一文字ずつ格納する。
    foreach ($wordletters as $letter) {
        $show .= $right[$letter];
    }
    var_dump($show);    //$word = 'word',$guess = 'o' ならば$show = '.o..'と表示される。

} else {
    //stristrは$word内部で$guessが見つからないとfalseとなるのだろうか？
    $show = '';
    $wrong[$guess] = $guess;
    if (count($wrong) == 6) {
        //間違った回数が6になったらゲームオーバー
        $show = $word;
    } else {
        $wordletters = str_split($word);    //文字列を配列に変換。第二引数が無記入ならば一文字ずつ格納する。
        foreach ($wordletters as $letter) {
            $show .= $right[$letter];
        }
    }
    print $show;
    print_r($wrong);
}

//リスト19
foreach ($words as $word) {
    if (preg_match("/^" . $_POST['guess'] . "$/",$word)) {
        echo $word . "<br />\n";
    }
}

