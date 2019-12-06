<?php

/*
 * 3d10-simple-poker-dealer.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

/* First, we have the suits */

$suits = array (
    "&spades;", "&#9825;", "&clubs;", "&#9826;"
);

/* Next, we declare the faces*/

$faces = array (
    "2", "3", "4", "5", "6", "7", "8",
    "9", "10", "J", "Q", "K", "A"
);

/* Now build the deck by combining the faces and suits. */

$deck = array();

foreach ($suits as $suit) {
    foreach ($faces as $face) {
        $deck[] = array('face'=>$face,'suit'=>$suit);
    }
}

/* Next, you can shuffle up the deck and pull a random card. */

shuffle($deck);

$hand = array();

if (empty($_POST)) {
    
    for ($i = 0; $i < 5; $i++) {
        $hand[] = array_shift($deck);
    }

    $handstr = serialize($hand);    //serializeで梱包。
    $handstr = base64_encode($handstr);
    $deckstr= serialize($deck);
    $deckstr = base64_encode($deckstr);
    ?>
<form method='post'>
<input type='hidden' name='handstr' value = '<?php echo $handstr ?>' />
<input type='hidden' name='deckstr' value = '<?php echo $deckstr ?>' />
<?php

foreach ($hand as $index =>$card) {
    echo "<input type='checkbox' name='card[" . $index . "]' /> " . $card['face'] . ' of ' . $card['suit'] . "<br />";
}

?>
<input type='submit' value='draw' />
</form>
<?php

} else {
    // $hand = base64_decode(unserialize($_POST['handstr']));
    // $hand = unserialize($_POST['handstr']);
    $hand = unserialize(base64_decode($_POST['handstr']));
    // $deck = base64_decode(unserialize($_POST['deckstr']));
    // $deck = unserialize($_POST['deckstr']);
    $deck = unserialize(base64_decode($_POST['deckstr']));
    // var_dump($hand);
    for ($i = 0; $i < 5; $i++) {
        if (isset($_POST['card'][$i])) {
            $hand[$i] = array_shift($deck);
        }
    }

    foreach ($hand as $index =>$card) {
        echo $card['face'] . ' of ' . $card['suit'] . "<br />";
    }
    echo "<a href='simplePoker.php'>Try Again</a>";
    
}

?>