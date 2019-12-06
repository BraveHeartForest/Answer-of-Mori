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


		$conn = new Connect();


		$sql = "
INSERT INTO 
menu(
name,
price,
contents,
comment)

VALUES(
?,
?,
?,
?)";





		$data[] = $post['pro_name'];
		$data[] = $post['price'];
		$data[] = $post['contents'];
		$data[] = $post['comment'];

		$conn->plural($sql, $data);



		?>
		<table class="table table-striped">
			<tr>
				<th>商品名</th>
				<td><?= $post['pro_name'] ?></td>
			</tr>
			<tr>
				<th>値段</th>
				<td><?= $post['price'] ?>円</td>
			</tr>
			<tr>
				<th>コンテンツ</th>
				<td><?= $post['contents'] ?></td>
			</tr>
			<tr>
				<th>コメント</th>
				<td><?= $post['comment'] ?></td>
			</tr>
		</table>

		<?php

		print '<p>を追加しました。</p>';


		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a><br>';
		print '<a href="./sign.html"><button class="btn btn-primary">追加画面に戻る。</button></a>';
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}

	?>
</body>

</html>