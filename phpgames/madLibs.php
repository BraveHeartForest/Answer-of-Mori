<?php
$text = "I was _VERB_ing in the _PLACE_ when I found a _NOUN_. I _VERB_ed in, and _VERB_ed too much _NOUN_.  I had to go to the _PLACE_.";

$verbs = array('pump', 'jump', 'walk', 'swallow', 'crawl', 'wail', 'roll');
$places = array('park', 'hospital', 'arctic', 'ocean', 'grocery', 'basement', 'attic', 'sewer');
$nouns = array('water', 'lake', 'spit', 'foot', 'worm', 'dirt', 'river', 'wankel rotary engine');

while (preg_match("/(_VERB_)|(_PLACE_)|(_NOUN_)/", $text, $matches)) {
    switch ($matches[0]) {
        case '_VERB_' :
            shuffle($verbs);
            $text = preg_replace('/'.$matches[0].'/', current($verbs), $text, 1);
            //current — 配列内の現在の要素を返す
            //current ( array $array ) : mixed
            // '/'でmatches[0]を挟むことで"_"を消せるようになる。理由は？
            break;
        case '_PLACE_' :
            shuffle($places);
            $text = preg_replace('/'.$matches[0].'/', current($places), $text, 1);
             break;
        case '_NOUN_' :
            shuffle($nouns);
            $text = preg_replace('/'.$matches[0].'/', current($nouns), $text, 1);
            break;
    }
}

echo $text;