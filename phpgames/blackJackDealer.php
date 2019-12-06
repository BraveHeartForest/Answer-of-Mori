<?php

$faces = [
    "two" => "2",
    "three" =>"3",
    "four" =>"4",
    "five" =>"5",
    "six" =>"6",
    "seven"=>"7",
    "eight"=>"8",
    "nine" =>"9",
    "ten" =>"10",
    "J" =>"10",
    "Q"=>"10",
    "K"=>"10",
    "A"=>"11",
];

function evaluateHand($hand) {
    //与えられた手札を評価する関数。
    global $faces;
    $value = 0;
    foreach($hand as $card) {
        if($value > 11 && $card['face'] == 'A') {
            $value = $value + 1;
            //Aは11か1のどちらかを選べます。
        }else{
            $value = intval($value) + intval($faces[$card['face']]);
        }
    }
    return $value;
}