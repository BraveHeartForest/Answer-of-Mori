<?php

function roll($sides) {
    return mt_rand(1,$sides);
    // rand(1,6)でも同様に1~6までを選択するが、mt_randの方が高速かつ優れた乱数生成関数です。
}

$weapons = [
    'LittleStick' => array(
        'name' => '小さな棒',
        'roll' => '1d6',
        'bonus' => '0',
    ),
    'BigStick' => array(
        'name' => '大きな棒',
        'roll' => '1d6',
        'bonus' => '4',
    ),
    'ChainSow' => array(
        'name' => '神殺しチェーンソー',
        'roll' => '2d8',
        'bonus' => '0',
    ),
];
print "<table><tr><th>武器名</th><th>ダメージ計算</th><th>ダメージ</th></tr>";
foreach($weapons as $weapon) {
    list($count, $sides) = explode('d', $weapon['roll']);
    //weaponsのrollをdで分割(explode)する。左側（個数）を$countに、右側（何面ダイス）を$sidesに代入。
    $result = 0;
    for($i = 0;$i < $count; $i++) {
        $result = $result + roll($sides);
    }
    print "<tr><td>".$weapon['name']."</td><td>".$weapon['roll'];
    if($weapon['bonus'] > 0) {
        print "+".$weapon['bonus'];
        $result = $result + $weapon['bonus'];
    }
    print "</td><td>".$result."</td></tr>";
}
print "</table>";

print "<br><br>現在使用中のPHPのバージョンは".phpversion();