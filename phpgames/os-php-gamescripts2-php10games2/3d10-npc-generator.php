<?php

/*
 * 3d10-npc-generator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

function roll($sides) {
    return mt_rand(1,$sides);
}

$rules = array(
    'health' => '36',
    'gore' => 'health/6',
    'clutch' => '1d6',
    'brawn' => '1d6',
    'sense' => '1d6',
    'flail' => '1d6',
    'chuck' => '1d6',
    'lurch' => '1d6',
);

$male = explode("\n", file_get_contents('names.male.txt'));
//file_get_contentsはファイルの内容を全て文字列に読み込む。
//explodeで改行部分で分割して配列に変換。
$female = explode("\n", file_get_contents('names.female.txt'));
$last = explode("\n", file_get_contents('names.last.txt'));

/* Shuffle the name arrays, or you'll get the same results every time */

shuffle($male);
shuffle($female);
shuffle($last);

for ($i = 1; $i <= 10; $i++) {
    echo "<h5>Character Data No.$i</h5>Male Name : " . $male[$i] . ' ' . $last[$i] . "<br />\n";
    echo "Female Name : " . $female[$i] . ' ' . $last[$i] . "<br />\n";

    foreach ($rules as $stat=>$rule) {
        if (preg_match("/^[0-9]+$/", $rule)) {
            //$ruleを指定したパターンで検索する。
            // This is only a number, and is therefore a static value
            $character[$stat] = $rule;
        } elseif (preg_match("/^([0-9]+)d([0-9]+)/", $rule, $matches)) {
            // This is a die roll
            //preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] ) : int
            //matches を指定した場合、検索結果が代入されます。 $matches[0] にはパターン全体にマッチしたテキストが代入され、 $matches[1] には 1 番目のキャプチャ用サブパターンにマッチした文字列が代入され、といったようになります。
            $val = 0;
            for ($n = 0;$n<$matches[1];$n++) {
                //処理内容から逆算するとmatches[1]は2d6で言うならば2の方
                $val = $val + roll($matches[2]);
                //処理内容から逆算するとmatches[2]は2d6で言うならば6の方
            }
            $character[$stat] = $val;
        } elseif (preg_match("/^([a-z]+)\/([0-9]+)$/", $rule, $matches)) {
            // This is a derived value of some kind.
            $character[$stat] = $character[$matches[1]] / $matches[2];
        }
        echo $stat . ' : ' . $character[$stat] . "<br />\n";
    }
}


?>