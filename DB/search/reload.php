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


		$id = $_GET['id'];

		if ($id == '') {
			print '<h1 class="bg-primary">変更したいデータにチェックを付けてください。</h1>';

			print '<form>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
			print '<br>';
			print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
		} else {

			print '<h1 class="bg-primary">変更ページ</h1>';
			print '<p>id:' . $id . '</p>';


			print '<form method="post" action="./reload_check.php">';

			print '<div class="form-group">';
			print '<p>商品名:</p>';
			print '<input type="text" name="name">';
			print '</div>';

			print '<div class="form-group">';
			print '<p>値段:</p>';
			print '<input type="text" name="price">';
			print '</div>';

			print '<div class="form-group">';
			print '<p>内容:</p>';
			print '<textarea name="contents" class="col-xs-12"></textarea>';
			print '</div>';

			print '<div class="form-group">';
			print '<p>コメント:</p>';
			print '<input type="text" name="comment">';
			print '</div>';
			?>

			<input type="hidden" name="id" value="<?= $id ?>">

			<?php
			print '<input type="submit" value="修正">';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
			print '<br>';
			print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
		}
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}
	?>
</body>

</html>