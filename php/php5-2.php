<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP5-(2)</title>
	<!--CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--自作CSS-->
	<style type="text/css">
		p {
			font-size: 20px;
		}


		h1 {}

		h2 {}

		h3 {}
	</style>
</head>

<body>
	<?php
	require_once('./forest_function2.php');
	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/

	print '<h1 class="bg-primary">関数課題２</h1>';
	print '<h2 class="bg-success">関数課題１を参照渡しにする<br>
returnは正常はtrue、異常はfalseとする
</h2>';

	$num1 = 123;
	$num2 = 456;
	$zero = 0;
	$add = add($num1, $num2);


	minus();	//画面上には表示されません

	print add($num1, $num2) . '<br>';
	print $add . '<br>';

	print minus($num1, $num2) . '<br>';
	print div($num1, $num2) . '<br>';
	print mod($num1, $num2) . '<br>';
	print mod($num2, $num1) . '<br>';

	print minus() . '<br>';	//Null値にならないように、変数未入力の場合のデフォルト値を設定してあります。↓はしてないです。
	print div($num1, $zero) . '<br>';
	print mod($num1, $zero) . '<br>';
	print mod($zero, $num1) . '<br>';

	print '<p>______________ここまでが課題１の部分______________</p>';
	print '<p>$num1=789,$num2=2019,$zero=0.1に変更する。<br>
forest_function2.phpでは参照渡しに設定されている。</p>';

	$num1 = 789;
	$num2 = 2019;
	$zero = 0.1;



	print add($num1, $num2) . '<br>';	//789+2019=2808(変更後の値を足した）
	print $add . '<br>';	//123+456=579（変更前のものをそのまま持ってきている。

	print minus($num1, $num2) . '<br>';	//789-2019=-1230
	print div($num1, $num2) . '<br>';	//789/2019=0.39078752
	print mod($num1, $num2) . '<br>';	//789/2019のあまり
	print mod($num2, $num1) . '<br>';	//2019/789のあまり

	print minus() . '<br>';	//Null値にならないように、変数未入力の場合のデフォルト値を設定してあります。↓はしてないです。
	print div($num1, $zero) . '<br>';	//789/0.1=789*10=7890
	print mod($num1, $zero) . '<br>';	//あまりが出るのは全て整数の場合で、0.1は有理数。
	print mod($zero, $num1) . '<br>';	//0.1を2019で割るときのあまりは0


	print "<pre>
\$num1 = 123;
\$num2 = 456;
\$zero = 0;
\$add = add(\$num1,\$num2);


minus();	//画面上には表示されません

print add(\$num1,\$num2).'&lt;br&gt;';
print \$add.'&lt;br&gt;';

print minus(\$num1,\$num2).'&lt;br&gt;';
print div(\$num1,\$num2).'&lt;br&gt;';
print mod(\$num1,\$num2).'&lt;br&gt;';
print mod(\$num2,\$num1).'&lt;br&gt;';

print minus().'&lt;br&gt;';	//Null値にならないように、変数未入力の場合のデフォルト値を設定してあります。↓はしてないです。
print div(\$num1,\$zero).'&lt;br&gt;';
print mod(\$num1,\$zero).'&lt;br&gt;';
print mod(\$zero,\$num1).'&lt;br&gt;';

print'&lt;p&gt;______________ここまでが課題１の部分______________&lt;/p&gt;';
print'&lt;p&gt;\$num1=789,\$num2=2019,\$zero=0.1に変更する。&lt;br&gt;
forest_function2.phpでは参照渡しに設定されている。&lt;/p&gt;';

\$num1 = 789;
\$num2 = 2019;
\$zero = 0.1;



print add(\$num1,\$num2).'&lt;br&gt;';	//789+2019=2808(変更後の値を足した）
print \$add.'&lt;br&gt;';	//123+456=579（変更前のものをそのまま持ってきている。

print minus(\$num1,\$num2).'&lt;br&gt;';	//789-2019=-1230
print div(\$num1,\$num2).'&lt;br&gt;';	//789/2019=0.39078752
print mod(\$num1,\$num2).'&lt;br&gt;';	//789/2019のあまり
print mod(\$num2,\$num1).'&lt;br&gt;';	//2019/789のあまり

print minus().'&lt;br&gt;';	//Null値にならないように、変数未入力の場合のデフォルト値を設定してあります。↓はしてないです。
print div(\$num1,\$zero).'&lt;br&gt;';	//789/0.1=789*10=7890
print mod(\$num1,\$zero).'&lt;br&gt;';	//あまりが出るのは全て整数の場合で、0.1は有理数。
print mod(\$zero,\$num1).'&lt;br&gt;';	//0.1を2019で割るときのあまりは0
</pre>";
	print '<h3 class="bg-info">参照渡しの効果がこれでは全く分からないので、php5omake.phpを見る事。</h3>';
	print '<a href="./php5omake.php">anchor</a>';
	?>
</body>

</html>