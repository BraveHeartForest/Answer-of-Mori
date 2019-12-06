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
	include('./forest_function1.php');
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

	$val1 = 123;
	$val2 = 456;
	$zero = 0;
	$str1 = 'Next';
	$str2 = 'Thought';

	add($val1, $val2);
	add();
	print '<p>↑はデフォルト値を設定していない時のものです。<br>Null参照をした結果エラーメッセージが表示されています。</p>';
	minus();
	minus($str1, $str2);
	add($str1, $str2);

	div($val1, $zero);
	div($val1, $val2);

	mod($val2, $val1);
	mod($val1, $val2);
	mod($val1, $zero);
	mod($zero, $val1);

	mod($str1, $str2);
	mod($val2, $val1);

	print "<pre>

\$val1=123;
\$val2=456;
\$zero=0;
\$str1='Next';
\$str2='Thought';

add(\$val1,\$val2);
add();
print'&lt;p&gt;↑はデフォルト値を設定していない時のものです。&lt;br&gt;Null参照をした結果エラーメッセージが表示されています。&lt;/p&gt;';
minus();
minus(\$str1,\$str2);
add(\$str1,\$str2);

div(\$val1,\$zero);
div(\$val1,\$val2);

mod(\$val2,\$val1);
mod(\$val1,\$val2);
mod(\$val1,\$zero);
mod(\$zero,\$val1);
</pre>";

	print '<a href="https://qiita.com/kazu56/items/50b35c9ee0e5c6c4e75e">参考サイト</a>';
	?>
</body>

</html>