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
		require_once("../funCLASS/classSQL.php");

		$post = sanitize($_POST);

		$id = $post['id'];
		$name = $post['name'];
		$price = $post['price'];
		$contents = $post['contents'];
		$comment = $post['comment'];


		print '<h1 class="bg-primary">id:' . $id . 'の変更画面</h1>';


		$conn = new Connect();


		print '<p>id:' . $id . '</p>';
		print '<p>name:' . $name . '</p>';
		print '<p>price:' . $price . '</p>';
		print '<p>contents:' . $contents . '</p>';
		print '<p>comment:' . $comment . '</p>';
		print '<p>に変更しました。</p>';


		$data = array();


		$data[] = $name;
		$data[] = $price;
		$data[] = $contents;
		$data[] = $comment;

		$sql = "UPDATE menu SET name=?,price=?,contents=?,comment=? WHERE id=$id";

		$conn->plural($sql, $data);




		print '<a href="menu.php"><button class="btn btn-success">検索メニューに戻る。</button></a>';
		print '<br>';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}

	?>
</body>

</html>