<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(5)</title>
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

	print '<h1>' . __LINE__ . '</h1>';
	print '<br>↑は行番号を表しています。↓はファイルのフルパスとファイル名です。<br>';
	print '<h1>' . __FILE__ . '</h1>';

	print '<br>';
	print 'アンダーバー*2で挟む__LINE__などをマジカル定数と呼びます。<br>
PHPで標準的に定義されている物の内、使われ方によって変化する定数を表します。<br>
この定数は大文字小文字を区別しません。';

	?>
</body>

</html>