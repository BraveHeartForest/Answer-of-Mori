<?php


function makeDeck(){
    $deck = array();    //配列を初期化
    $suits = array(
        "&spades;","&hearts;","&clubs;","&diams;"
    );

    $faces = [
        "2","3","4","5","6","7","8","9","10","J","Q","K","A"
    ];

    foreach($suits as $suit) {
        foreach($faces as $face) {
            $deck[] = array("face"=>$face,"suit"=>$suit);
        }
    }
    shuffle($deck);
    return $deck;
}

$deck = makeDeck(); //初期化

shuffle($deck);

// var_dump($deck);

$card = array_shift($deck); //配列の先頭から要素を一つ取り出す。要素一つ分だけ短くなり、全ての要素は前にずれます。 数値添字の配列のキーはゼロから順に新たに振りなおされますが、 リテラルのキーには影響しません。
print $card['face'].' of '.$card['suit'].'<br>';


// $hands = array(1 => array(), 2 => array());

// for($i = 0; $i < 5; $i++) {
//     //5枚のカードを持つ2つの手を作る。
//     $hands[1][] = implode(" of ",array_shift($deck));   //" of "の部分で区切って配列に変換
//     $hands[2][] = implode(" of ",array_shift($deck));
//     //引数に$iが出現しないがarray_shitで毎回変更されるので特に問題なし。
// }

//関数に作り替えると$deckの枚数が減らない。&を付けて参照渡しにすることで解決。
function makeHands(&$deck){
    $hands = array(1 => array(), 2 => array());

    for($i = 0; $i < 5; $i++) {
        //5枚のカードを持つ2つの手を作る。
        $hands[1][] = implode(" of ",array_shift($deck));   //" of "の部分で区切って配列に変換
        $hands[2][] = implode(" of ",array_shift($deck));
        //引数に$iが出現しないがarray_shitで毎回変更されるので特に問題なし。
    }
    return $hands;
}

$hands = makeHands($deck);
var_dump($hands);


function caluculate_odds($draw, $deck) {
    //$drawは引きたいカードの情報を持つ配列
    $remaining = count($deck);
    $odds = 0;
    foreach($deck as $card) {
        if( ($draw['face'] == $card['face'] && $draw['suit'] == $card['suit']) ||    //「引いたカードのフェイスが引きたいカードのフェイスと同一」かつ「カードのスートが存在する」
        ($draw['face'] == '' && $draw['suit'] == $card['suit'] ) || //「引きたいカードのフェイス指定が無い」かつ「引いたスートが同一」
        ($draw['face'] == $card['face'] && $draw['suit'] == '' ) ) {    //「引いたカードのフェイスが引きたいカードのフェイスと同一」かつ「引きたいカードのスートが未指定」
            $odds++;
        }
    }
    return $odds.' in '.$remaining;
}

$draw = [
    'face' => 'Ace',
    // 'face' => '',
    'suit' => 'Spades',
    // 'suit' => '',
];

print implode(" of ",$draw).' : '.caluculate_odds($draw, $deck)."<br>";

print"<h1>単純なポーカー・ディーラーを作成。</h1>";
$deck = makeDeck();

// var_dump($deck);

$hand = array();
//5枚のカードを持つ手を作る。
for($i = 0; $i < 5; $i++) {
    $hand[] = array_shift($deck);
    //引数に$iが出現しないがarray_shitで毎回変更されるので特に問題なし。
}

// $deck = serialize($deck);
// $deck = base64_encode($deck);
// $deck = json_encode($deck);
// var_dump($deck);
// var_dump($hand);
print '<form method="POST" action="cardChange.php">';
foreach ($hand as $index =>$card) {
    echo "<input type='checkbox' name='card[" . $index . "]'>" . $card['face'] . ' of ' . $card['suit'] . "<br />";
    print '<input type="hidden" name="old_hand['.$index.']" value="'.$card['face'].' of '.$card['suit']."<br>".'">';
}

foreach($deck as $index => $card) {
    print '<input type="hidden" name="deck['.$index.']" value="'.$card['face'].' of '.$card['suit']."<br>".'">';
}


// print '<input type="hidden" name="deck" value="'.$deck.'">';
print '<input type="submit" value="交換">';
print '</form>';