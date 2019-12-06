<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP3-(1)</title>
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

	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/


	print '<h1 class="bg-primary">（２） 条件演算子を使用してメッセージを出力する</h1>';
	print '<h2 class="bg-success">尚、調査の結果「三項演算子」の呼称が多数派の模様。</h2>';
	print '<h3 class="bg-info">そも、三項演算子とは？</h3>';
	print '<p class="text-warning bg-warning">[条件式 ? 真の式 : 偽の式]の形式で書かれるものです。</p>';

	$x_1 = 'Good morning!';

	$x_1 == 'Good luck!' ? print '<p>Good luck!</p>' : print '<p>Bad luck!</p>';

	print "<pre>
$x_1 = 'Good morning!';

$x_1 == 'Good luck!' ? print'Good luck!' : print'Bad luck!';
</pre>";


	?>
</body>

</html>