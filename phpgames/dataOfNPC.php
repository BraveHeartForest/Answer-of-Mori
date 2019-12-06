<?php

$character = array(
    'name' => 'Fred The Zombie',
    'health' => '36',
    'gore' => '1',
    'clutch' => '5',
    'brawn' => '6',
    'sense' => '4',
    'flail' => '2',
    'chuck' => '3',
    'lurch' => '4',
);

$filename = substr(preg_replace("/[^a-z0-9]/", "", strtolower($character['name'])), 0, 20);
file_put_contents($filename, serialize($character));
?>
<input name='health' value='<?php echo $character['health'] ?>' />

<?

$rules = array(
    'health' => '36',
    'gore' => 'health/6',
    'clutch' => '1d6',
    'brawn' => '1d6',
    'sense' => '1d6',
    'flail' => '1d6',
    'chuck' => '1d6',
    'lurch' => '1d6',
);

foreach($rules as $stat => $rule) {
    if(preg_match("/^[0-9]+$/",$rule)) {
        //これは数字のみで、静的な値です。
        $character[$stat] = $rule;
    } elseif(preg_match("/^([0-9]+)d([0-9]+)/",$rule,$matches)) {
        //これはダイスロール
        $val = 0;
        for($n = 0; $n < $matches[1]; $n++) {
            $val = $val + roll($matches[2]);
        }
        $character[$stat] = $val;
    } elseif(preg_match("/^([a-z]+)\/([0-9]+)$/",$rule,$matches)) {
        //これは数種類の配られた値。
        $character[$stat] = $character[$matches[1]] / $matches[2];
    }
    print $stat. ' : '.$character[$stat]."<br>\n";
}