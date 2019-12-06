<?php

function roll($sides) {
    return mt_rand(1,$sides);
    // rand(1,6)でも同様に1~6までを選択するが、mt_randの方が高速かつ優れた乱数生成関数です。
}

echo roll(6)."<br>";   //roll a six-sided dice
print roll(10)."<br>";  //roll a ten-sided dice
print roll("20")."<br>"; //roll a twenty-sided dice