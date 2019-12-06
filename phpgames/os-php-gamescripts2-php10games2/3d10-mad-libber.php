<?php

/*
 * 3d10-mad-libber.php
 * by Duane O'Brien - http://chaoticneutral.net
 * written for IBM DeveloperWorks
 */

$text = "I was _VERB_ing in the _PLACE_ when I found a _NOUN_. \n<br> I _VERB_ed in, and _VERB_ed too much _NOUN_. \n<br> I had to go to the _PLACE_.";

$verbs = explode("\n", file_get_contents("words.verbs.txt"));
$places = explode("\n", file_get_contents("words.places.txt"));
$nouns = explode("\n", file_get_contents("words.nouns.txt"));

while (preg_match("/(_VERB_)|(_PLACE_)|(_NOUN_)/", $text, $matches)) {
    //$mathces[0]に関してswitchする。$matches[0]にはパターン全体にマッチしたテキストが代入されます。
    switch ($matches[0]) {
        case '_VERB_' :
            shuffle($verbs);
            $text = preg_replace('/' . $matches[0] . '/', current($verbs), $text, 1);
            //current(Array)でArray[0]を返す。
            // '/' . $matches[0] . '/'が_VERB_を意味すし、次の引数で置き換える。
            //$verbs[0]で置き換える。
            //$text内部のものを置き換える。
            //置換を行う最大回数は1回です。
            break;
        case '_PLACE_' :
            shuffle($places);
            $text = preg_replace('/' . $matches[0] . '/', current($places), $text, 1);
            break;
        case '_NOUN_' :
            shuffle($nouns);
            $text = preg_replace('/' . $matches[0] . '/', current($nouns), $text, 1);
            break;
    }
}

echo $text . "\n";

