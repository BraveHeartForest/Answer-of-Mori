<?php

$s = 6;
$n = 2;

$results = array(array());
for($i = 0; $i < $n; $i++) {
    $newresults = array();
    foreach($results as $result) {
        for($x = 0; $x < $s; $x++) {
            $newresults[] = array_merge($result,array($x+1));
        }
    }
    $results = $newresults;
}

var_dump($results);