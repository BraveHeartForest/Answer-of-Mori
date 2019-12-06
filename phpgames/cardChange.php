<?php
$i = 0;
$deck = $_POST['deck'];
// var_dump($deck);
// $deck = base64_decode($deck);
// $deck = unserialize($deck);
// $deck = json_decode($deck);
// var_dump($deck);
for($j = 0; $j <= 4; $j++) {
    $hand[$j] = $_POST['old_hand'][$j];
}
while($i < 5) {
    if(isset($_POST['card'][$i])) {
        $hand[$i] = array_shift($deck);
    }
    $i++;
}

// var_dump($deck);

// var_dump($old_hand); //現在の手札を表すものになりました。

// var_dump($hand);

foreach($hand as $card) {
    print $card.'<br>';
}