<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP_SESSION(4)~(7)</title>
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



	print '<h2 class="bg-success">(6)セッション継続中に前のページで格納されたセッション変数を参照する。</h2>';
	print '<h3 class="bg-info">その続き。</h3>';

	$username = $_POST['username'];

	print '<p>ようこそ<strong>' . $username . '</strong>様。</p>';

	print '<button type="button" class="btn btn-primary" onclick="history.back()">前のページに戻る</button>';


	print "<pre>
\$username = \$_POST['username'];

print '&lt;p&gt;ようこそ&lt;strong&gt;'.\$username.'&lt;/strong&gt;様。&lt;/p&gt;';

print '&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot; onclick=&quot;history.back()&quot;&gt;前のページに戻る&lt;/button&gt;';
</pre>";

	print '<h2 class="bg-success">(7)セッションの破棄をする。</h2>';


	print '<a href="session_out.php"><button type="button" class="btn btn-info">セッションの破棄</button></a>';

	?>
</body>

</html>