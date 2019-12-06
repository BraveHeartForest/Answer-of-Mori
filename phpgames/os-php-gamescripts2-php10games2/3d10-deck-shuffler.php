<?php

/*
 * 3d10-deck-shuffler.php
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

shuffle($deck); //配列をシャッフルする。

$card = array_shift($deck); //配列の一番目を取り出す。取り出された配列は一つずつ番号が若くなる。

echo $card['face'] . ' of ' . $card['suit'] . "\n";

?>