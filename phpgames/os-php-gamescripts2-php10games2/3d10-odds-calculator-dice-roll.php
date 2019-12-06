<?php

/*
 * 3d10-odds-calculator-die-roll.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$s = 6;
//六面ダイス
$n = 2;
//二個
$results = array(array());
//配列の中に配列が組み込まれているものを定義する。
for ($i = 0; $i < $n; $i ++) {
    $newresults = array();
    foreach ($results as $result) {
        for ($x = 0; $x < $s; $x++) {
            $newresults[] = array_merge($result, array($x+1));
            //配列$newresultsに$resultの内容の後に($x+1)を要素として追加する。
            // var_dump($newresults);
            // print "<br>";
        }
    }
    $results = $newresults;
    // var_dump($results);
}

$sums = array();
$grid = array();
$total = 0;
foreach ($results as $result) {
    $sum = 0;
    $total++;
    // $total = count($result)ではない。
    $grid[$result[0]][] = $result[1]; //ダイスが2個より多い場合はこの部分を書き換える必要があります。
    // var_dump($grid);
    //Array [ [1] => Array(0=>1,1=>2,3=>4,...)
    foreach ($result as $num) {
        $sum = $sum + $num;
    }
    @$sums[$sum]++;
    // var_dump($sums);
    //@を付けないとNotice: undefined offsetとなり、$sumsに$sum番目の要素が存在しないといわれます。
}

?>
COMBINATIONS : <br />
<table border='1'>
<tr><td>Dice 1</td><td colspan='6'>Dice 2</td></tr>
<?php
foreach ($grid as $d1 => $row) {
    echo "<tr><td>" . $d1 . "</td><td>" . implode('</td><td>', $row) . "</td></tr>";
}
?>
</table><br />
SUMS : <br />
<?php

foreach ($sums as $sum=>$odds) {
    echo $sum . " : " . $odds . " in " . $total . "<br />\n";
}

?>