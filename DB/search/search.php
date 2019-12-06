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

		require_once("../funCLASS/function.php");

		$flag = 0;

		$post = sanitize($_POST);

		$minprice = &$post['minprice'];
		$maxprice = &$post['maxprice'];
		$pro_name = &$post['pro_name'];



		if ($pro_name == '') {
			print '<p class="bg-warning">商品名が入力されていません。</p>';
			print '<p><b>商品名では検索をしません。</b></p>';
		} else {
			print '<p>商品名<strong>【' . $pro_name . '】</strong>で検索を行います。</p>';
		}

		if (is_numeric($minprice)) {	//文字列が数字列の場合、
			$minprice = (int) $minprice;	//int型に変換しないとstr扱いされて$minprice===0がFになる。
		}


		if (is_numeric($maxprice)) {
			$maxprice = (int) $maxprice;
		}



		if ($minprice == '' || $minprice == null || $minprice === 0) {
			print '<p class="bg-warning">未入力の場合は自動で最低価格を<b>0</b>とします。</p>';
			$minprice = 0;
		} elseif (noCheck($minprice) == 1) {	//最低価格が0でなくかつ数値でもないならば
			print '<p class="bg-danger">最低価格が半角数字ではないか未入力です。</p>';
			$flag = 1;
		}

		if ($maxprice == '' || $maxprice == null) {
			print '<p class="bg-warning">未入力の場合は自動で最高価格を<b>1000000</b>とします。</p>';
			$maxprice = 1000000;
		} elseif (noCheck($maxprice) == 1) {
			print '<p class="bg-danger">最高価格が半角数字ではないか誤っています。</p>';
			$flag = 1;
		}




		if ($minprice < 0) {
			print '<p class="bg-danger">最低価格を0より大きくしてください。</p>';
			$flag = 1;
		}


		if ($maxprice < 0) {
			print '<p class="bg-danger">最高価格を0より大きくしてください。</p>';
			$flag = 1;
		}

		if ($minprice > $maxprice) {
			print '<p class="bg-danger">最低価格と最大価格が逆になっています。</p>';
			$flag = 1;
		}


		if ($flag == 1) {
			print '<p>値段は半角数字で入力してください。</p>';
			print '<form>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
		} else {
			print '<form method="post" action="./list.php">';
			?>
			<input type="hidden" name="pro_name" value="<?= $pro_name ?>">
			<input type="hidden" name="minprice" value="<?= $minprice ?>">
			<input type="hidden" name="maxprice" value="<?= $maxprice ?>">
			<?php

			if ($minprice !== $maxprice) {
				print "<p>値段は<strong>【" . $minprice . "～" . $maxprice . "】</strong>の間で検索します。</p>";
			} else {
				print "<p>値段は<strong>【" . $post['minprice'] . "】</strong>の値で検索します。</p>";
			}
			print '<input type="submit" value="検索"><br>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
		}	//end of else
		print '<br>';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}

	?>
</body>

</html>