<?php

/*
 * 3d10-hangman-generator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

 //serialize&unserializeについて https://www.sejuku.net/blog/80079

$letters = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

if (empty($_POST)) {
    //$_POSTが空のとき
    $words = explode("\n", file_get_contents('words.list.txt'));    //出題する単語を決定。
    $right = array_fill_keys($letters, '.');    //Array( [a] => '.' ,..., [z] => '.')
    $wrong = array();
    shuffle($words);    //wordsをシャッフル
    $word = strtolower($words[0]);  //$words[0]を小文字にしたものを代入。
    $rightstr = serialize($right);  //serialize — 値の保存可能な表現を生成する
    // var_dump($rightstr);    //string 'a:26:{s:1:"a";s:1:".";s:1:"b";s:1:".";s:1:"c";s:1:".";s:1:"d";s:1:".";s:1:"e";s:1:".";s:1:"f";s:1:".";s:1:"g";s:1:".";s:1:"h";s:1:".";s:1:"i";s:1:".";s:1:"j";s:1:".";s:1:"k";s:1:".";s:1:"l";s:1:".";s:1:"m";s:1:".";s:1:"n";s:1:".";s:1:"o";s:1:".";s:1:"p";s:1:".";s:1:"q";s:1:".";s:1:"r";s:1:".";s:1:"s";s:1:".";s:1:"t";s:1:".";s:1:"u";s:1:".";s:1:"v";s:1:".";s:1:"w";s:1:".";s:1:"x";s:1:".";s:1:"y";s:1:".";s:1:"z";s:1:".";}' (length=423)
    $wrongstr = serialize($wrong);
    $wordletters = str_split($word);    //文字列を一文字ずつの配列に変換。例：fish=>["f","i","s","h"]
    $show = '';
    foreach ($wordletters as $letter) {
        $show .= $right[$letter];
        //$wordの文字数分"."を$showに代入？
    }
} else {
    //$_POSTが空でない
    $word = $_POST['word'];
    $guess = strtolower($_POST['guess']);
    $right = unserialize($_POST['rightstr']);   //unserialize — 保存用表現から PHP の値を生成する
    $wrong = unserialize($_POST['wrongstr']);
    $wordletters = str_split($word);
    if (stristr($word, $guess)) {
        //stristr(string $haystack, mixed $needle [,bool $before_needle = FALSE]) : string :大文字小文字を区別しない。
        //haystackにおいてneedleが最初に見つかった位置を含めてそこから最後までを返します。
        // $email = 'USER@EXAMPLE.com';
        // echo stristr($email, 'e'); // 出力は ER@EXAMPLE.com となります
        // echo stristr($email, 'e', true); // PHP 5.3.0 以降では、出力は US となります

        //hangmanというゲームの仕様上、$wordは単語、$guessは一文字であるべき
        $show = ''; //文字列の初期化
        $right[$guess] = $guess;
        $wordletters = str_split($word);
        foreach ($wordletters as $letter) {
            $show .= $right[$letter];
        }
        if(!stristr($show,".")){
            $show .= "<br><h2>You win!</h2>";
            //$showに"."が含まれなくなった場合
        }
        
    } else {
        //$wordの中に$guessが存在しない場合はFALSEが返ってきます。
        $show = '';
        $wrong[$guess] = $guess;
        if (count($wrong) == 6) {
            $show = $word."<br><h2>You losed.</h2>";  //$wrongの中身が6に達したらGAMEOVER
        } else {
            foreach ($wordletters as $letter) {
                $show .= $right[$letter];
            }
        }
    }
    $rightstr = serialize($right);  //ここでserializeしたものをinput:hiddenで自身に送信。
    $wrongstr = serialize($wrong);
}

?>
Bad Guesses : <?php echo implode(', ', $wrong) ?><br />
<?php echo $show ?><br />
<form method='post'>
<input name='guess' />
<input type='hidden' name='word' value='<?php echo $word ?>' />
<input type='hidden' name='rightstr' value='<?php echo $rightstr ?>' />
<input type='hidden' name='wrongstr' value='<?php echo $wrongstr ?>' />
<input type='submit' value='guess' />
</form>
<a href='3d10-hangman-generator.php'>Start Over</a>