<?php

function add1 ($number) {
    return ++$number;
}


function add2 (&$number) {    // 「&」を引数につける
    return ++$number;
}

function modulor($int1,$int2){
if($int1<$int2 || $int2==0 || $int2<0){
	print'先に入力する変数の方が大きくなるようにしてください。';
	exit();
}
	$mod=$int1 % $int2;
	while($mod>0){
		if($mod != 0){
			$last = $mod;
		}	//if end
	$mod = $int2 % $mod;
		}// while end
print $int1.'と'.$int2.'は'.$last.'を法として合同である。';
}
