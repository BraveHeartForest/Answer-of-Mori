<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP5-(1)</title>
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
	include('./forest_function.php');
	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/
	print '<h1 class="bg-primary">関数課題１</h1>';
	print '<h2 class="bg-success">算術演算子add、minus、div、％の各関数作成<br>
includeで実現（定義と呼び出し）</h2>';
	$num1 = 123;
	$num2 = 345;
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
	print add() . '<br>';	//わざとエラーが出るように設定しました。↑のminusと比較してください。
	print div($num1, $zero) . '<br>';
	print mod($num1, $zero) . '<br>';
	print mod($zero, $num1) . '<br>';



	print "<pre>
\$num1 = 123;
\$num2 = 345;
\$zero = 0;
\$add = add(\$num1,\$num2);


minus();	//画面上には表示されません

print add(\$num1,\$num2).'&lt;br&gt;';
print \$add.'<br>';

print minus(\$num1,\$num2).'&lt;br&gt;';
print div(\$num1,\$num2).'&lt;br&gt;';
print mod(\$num1,\$num2).'&lt;br&gt;';
print mod(\$num2,\$num1).'&lt;br&gt;';

print minus().'&lt;br&gt;';	//Null値にならないように、変数未入力の場合のデフォルト値を設定してあります。↓はしてないです。
print add().'&lt;br&gt;';	//わざとエラーが出るように設定しました。↑のminusと比較してください。
print div(\$num1,\$zero).'&lt;br&gt;';
print mod(\$num1,\$zero).'&lt;br&gt;';
print mod(\$zero,\$num1).'&lt;br&gt;';


</pre>";

	?>
</body>

</html>