<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(3)</title>
	<!--CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--自作CSS-->
	<style type="text/css">
		p {
			text-align: center;
		}


		h1 {
			text-align: center;
		}

		h2 {
			text-align: center;
		}

		h3 {
			text-align: center;
		}
	</style>
</head>

<body>
	<?php
	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/

	print '<h1 class="bg-primary">文字列と数値を結合する。</h1>';

	$num1 = 10;
	$num2 = 20;
	$str1 = '文字列A';
	$str2 = '文字列B';
	print '<h3 class="bg-info">上がドットで文字列として繋げる。下が+で数値として計算する。</h3>';
	print $num1 . $num2 . '<br>';
	print $num1 + $num2 . '<br>';
	print '<h3 class="bg-info">上がドットで文字列として繋げる。下が+で数値として計算する。</h3>';
	print $num1 . $str1 . '<br>';
	print $num1 + $str1 . '<br>';


	?>
</body>

</html>