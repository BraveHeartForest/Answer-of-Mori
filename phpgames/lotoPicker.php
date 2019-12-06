<?php

$picks = array(
    array('6', '10', '18', '21', '34', '40'),
    array('2', '8', '13', '22', '30', '39'),
    array('3', '9', '14', '25', '31', '35'),
    array('11', '12', '16', '24', '36', '37'),
    array('4', '7', '17', '26', '32', '33')
);

$numbers = array_fill(1,40,0);
//array_fill — 配列を指定した値で埋める
//$numbersは1から40までのインデックスを持つ配列で、その要素の値は0です。

// var_dump($numbers);

foreach ($picks as $pick) {
    //$picksの各配列を取り出す。
    foreach ($pick as $number) {
        //$picksから取り出した配列$pickの各要素$numberを使い、
        $numbers[$number]++;    //$numbers[]の$number目の値を+1する。
    }
}
// var_dump($numbers);


asort($numbers);
//asort — 連想キーと要素との関係を維持しつつ配列をソートする（昇順）逆順の場合はarsort()を用います。
// var_dump($numbers);


$pick = array_slice($numbers,0,6,true);
//array_slice ( array $array , int $offset [, int $length = NULL [, bool $preserve_keys = FALSE ]] ) : array
//$numbersを0番目から開始して、要素数が6になるように連続する要素を返します。
//array_slice() はデフォルトで配列の数値キーを並べなおし、 リセットすることに注意してください。
//trueにすることでこの動作を変更できます。

var_dump($pick);

echo implode(',', array_keys($pick));
//array_keys($pick)を","で繋いだものを表示。
//array_keys — 配列のキーすべて、あるいはその一部を返す

var_dump(array_keys($pick));
