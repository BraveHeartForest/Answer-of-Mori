﻿<!DOCTYPE html>
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
		require_once("../funCLASS/classSQL.php");

		$post = sanitize($_POST);

		$id = $post['id'];
		$name = $post['name'];
		$price = $post['price'];
		$contents = $post['contents'];
		$comment = $post['comment'];

		if (noCheck($price) === 1) {

			print '<h2 class="bg-danger">値段は半角数字で入力してください。</h2>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '<br>';
			print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
		} else {

			$conn = new Connect();

			$sql = "SELECT * FROM menu WHERE id = $id";

			$data = array();	//reset

			$data = array('', '', '', '', '');


			$stmt = $conn->plural($sql, $data);

			foreach ($stmt as $value) {
				print '<p>id:' . $value['id'] . '</p>';
				print '<p>name:' . $value['name'] . '</p>';
				print '<p>price:' . $value['price'] . '</p>';
				print '<p>contents:' . $value['contents'] . '</p>';
				print '<p>comment:' . $value['comment'] . '</p>';
			}

			print 'を<br>';
			print '<p>id:' . $id . '</p>';
			print '<p>name:' . $name . '</p>';
			print '<p>price:' . $price . '</p>';
			print '<p>contents:' . $contents . '</p>';
			print '<p>comment:' . $comment . '</p>';
			print '<p>に変更してもよろしいですか。</p>';


			print '<form method="post" action="./reload_done.php">';
			?>
			<input type="hidden" name="id" value="<?= $id ?>">
			<input type="hidden" name="name" value="<?= $name ?>">
			<input type="hidden" name="price" value="<?= $price ?>">
			<input type="hidden" name="contents" value="<?= $contents ?>">
			<input type="hidden" name="comment" value="<?= $comment ?>">

			<?php
			print '<input type="submit" value="修正"><br>';
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