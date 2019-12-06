<?php

function add( $num1 , $num2)
{
return($num1 + $num2);

}	//add閉じ

function minus( $num1=1 , $num2=1)
{
/*
事前に引数に$num1=1と入れておくことで、
関数を使用する時に$num1を関数ユーザーが入れ忘れてもデフォルト値を設定できる。
*/

return($num1 - $num2);

}	//minus閉じ


function div( $num1 , $num2)
{
	if($num2==0){
		return('<p>数値を0で割ってはいけません。</p>');
		}else{

	return($num1 / $num2);
	}
}

function mod($num1, $num2)
{

	if($num2==0){
		return('<p>数値を0で割ってはいけません。</p>');
		}else{

	return($num1 % $num2);
	}
}
