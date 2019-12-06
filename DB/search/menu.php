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

		print '<h1 class="bg-primary">検索メニュー</h1>';
		print '<h2 class="bg-success">以下に検索条件を入力してください。</h2>';


		print '<form method="post" action="./search.php">';
		print '<h3 class="bg-info">商品検索</h3>';
		print '
<div class="form-group">
	<label for="product">商品名：</label>
	<input type="text" id="product" name="pro_name" class="form-control">
</div>';


		print '<h3 class="bg-info">価格検索</h3>';
		print '<p>最低価格と最大価格を入力してください。その範囲の商品が表示されます。</p>';
		print '
<div class="form-group">
	<label for="minprice">最低価格：</label>
	<input type="text" id="minprice" name="minprice" class="form-control">
</div>';

		print '
<div class="form-group">
	<label for="maxprice">最高価格：</label>
	<input type="text" id="maxprice" name="maxprice" class="form-control">
</div>';

		print '<input type="submit" value="送信"><br>';
		print '<input type="reset" value="リセット"><br>';
		print '</form>';
		print '<br>';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}
	?>
</body>

</html>