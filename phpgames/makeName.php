<?php

$male = [
    "William",
    "Henry",
    "Filbert",
    "John",
    "Pat",
];

$last = array(
    "Smith",
    "Jones",
    "Winkler",
    "Cooper",
    "Cline",
);

shuffle($male); //shuffle(array):bool 配列をシャッフルします。
shuffle($last);

for($i=0; $i<=3; $i++) {
    print $male[$i].' '.$last[$i]."<br>";
}

$male = explode('\n',file_get_contents('names.female.txt'));    //explode:文字列を文字列により分割する
$last = explode('\n',file_get_contents('names.last.txt'));  //file_get_contents:ファイルの内容を全て文字列に読み込む

// var_dump($male);
shuffle($male);