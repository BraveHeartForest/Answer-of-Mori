<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>DB</title>
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
	try {


		print '<h1 class="bg-primary">トップ画面</h1>';
		print '<h2 class="bg-success">ようこそXXXXさん。</h2>';
		print '<p class="text-success"><a href="./search/menu.php">検索メニューへ</a></p>';
		print '<p class="text-warning"><a href="./sign/sign.html">登録メニューへ</a></p>';
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}
	?>
</body>

</html>