<?php
//http://suipedia.net/blog/php/function/
//https://kinocolog.com/function/

function sanitize($before){

if(is_array($before)){

	//以下の部分は$beforeが配列であることが必須。
	foreach($before as $key => $value){	//配列$beforeを要素番号？と要素名？に分割する。
		$after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
		}	//foreach閉じ
	return $after;
	}else{

	$after = htmlspecialchars($before,ENT_QUOTES,'UTF-8');
	return $after;
	}


}


//数値チェック
function noCheck($no, $miss = 1){
	if(preg_match('/^[1-9][0-9]*$/', $no)){
		return (int)$no;
	}else{
		return $miss;
	}
}
