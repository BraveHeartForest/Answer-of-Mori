<?php

function add( $num1 , $num2)
{
$num3=$num1+$num2;
/*
return $num3;
//これを関数内部の処理結果を取得する場合に使います。

*/
print'<p>'.$num1.'と'.$num2.'の和は'.$num3.'です。</p>';

}	//add閉じ

function minus( $num1=1 , $num2=1)
{
/*
事前に引数に$num1=1と入れておくことで、
関数を使用する時に$num1を関数ユーザーが入れ忘れてもデフォルト値を設定できる。
*/
$num3 =$num1-$num2;
print'<p>'.$num1.'と'.$num2.'の差は'.$num3.'です。</p>';

}	//minus閉じ


function div( $num1 , $num2)
{
	if($num2==0){
		print'<p>数値を0で割ってはいけません。</p>';
		}else{

	$num3 =$num1/$num2;
	print'<p>'.$num1.'を'.$num2.'で割ったときの商は'.$num3.'です。</p>';
	}
}

function mod($num1, $num2)
{

	if($num2==0){
		print'<p>数値を0で割ってはいけません。</p>';
		}else{

	$num3 =$num1 % $num2;
	print'<p>'.$num1.'を'.$num2.'で割ったときの余りは'.$num3.'です。</p>';
	}
}
