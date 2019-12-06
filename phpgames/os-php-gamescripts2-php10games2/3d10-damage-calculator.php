<?php

/*
 * 3d10-damage-calculator.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* A really basic function to simulate rolling a simple die with N sides */

function roll($sides) {
    return mt_rand(1,$sides);
}

?>

<table border="1">
<tr><th>武器名</th><th>ダメージ計算</th><th>結果</th></tr>

<?php

$weapons = array (
    'littlestick' => array (
        'name' => 'ヒノキの棒',
        'roll' => '1d6',
        'bonus' => '0',
    ),
    'bigstick' => array (
        'name' => 'ヒノキの棒改',
        'roll' => '1d6',
        'bonus' => '4',
    ),
    'chainsaw' => array (
        'name' => '神殺しチェーンソー',
        'roll' => '2d8',
        'bonus' => '0',
    ),
);

foreach ($weapons as $weapon) {
    list($count, $sides) = explode('d', $weapon['roll']);
    //$weaponsのrollの文字列をｄで区切り、配列に変換する。仮にArray(a,b)とすると
    //listで$count = a, $sides = bというように各自を代入する。
    $result = 0;
    for ($i = 0; $i < $count;$i++) {
        //ここでは$countはdiceの個数を表している。
        $result = $result + roll($sides);
        //roll($sides)で$sides面ダイスを振った結果が$resultに代入される。
    }
    echo "<tr><td>" . $weapon['name'] . "</td><td>" . $weapon['roll'];
    if ($weapon['bonus'] > 0) {
        //もしダメージボーナスが存在する0よりも大きいならば、
        echo "+" . $weapon['bonus'];
        $result = $result + $weapon['bonus'];
        //$resultにダメージボーナスをプラスする。
    }
    echo "</td><td>" . $result . "</td></tr>";
}

?>
</table>