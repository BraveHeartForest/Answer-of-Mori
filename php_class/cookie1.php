<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP_COOKIE(1)-(2)</title>
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

	print '<h1 class="bg-primary">クッキーとセッション課題</h1>';
	print '<h2 class="bg-success">(1)クッキーの作成</h2>';
	print '<p>usernameでmicheleを作成せよ。</p>';


	print "<pre>
setcookie('名前','データ','有効期限');
setcookie('username','michele',time()+60*60*24*7);
現在時刻から一週間の有効期限（60秒*60分*24時間*7日)
</pre>";

	print '<h2 class="bg-success">クッキー「username」を参照する。</h2>';
	print '<p>usernameをチェック出来ればクッキー名を表示する。</p>';

	setcookie('username', 'michele', time() + 60 * 60 * 24 * 7);

	print "<p>" . $_COOKIE['username'] . "</p>";

	print "<pre>
setcookie('username','michele',time()+60*60*24*7);

print &quot;&lt;p&gt;&quot;.\$_COOKIE['username'].&quot;&lt;/p&gt;&quot;;
</pre>";



	print '<a href="./cookie2.php">次へ</a>';

	?>
</body>

</html>