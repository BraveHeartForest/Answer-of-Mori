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

		$pro_name = &$post['pro_name'];
		$minprice = &$post['minprice'];
		$maxprice = &$post['maxprice'];


		if ($pro_name == '') {
			$data[] = $minprice;
			$data[] = $maxprice;
		} else {
			$data[] = '%' . $pro_name . '%';	//ここで検索文字列を%xxx%として部分一致設定を盛り込みます。$pro_nameの末尾に\を入れるとエラーが発生しかねない。（野田さんから、発生しないことを確認したそうです）
			$data[] = $minprice;
			$data[] = $maxprice;
		}

		if ($pro_name == '') {

			$sql = "SELECT *
			FROM menu
			WHERE price BETWEEN ? AND ?";
		} else {

			$sql = "SELECT * 
			FROM menu 
			WHERE name LIKE ? AND 
			price BETWEEN ? AND ?";
		}



		$conn = new Connect();


		$items = $conn->plural($sql, $data);




		print '<table class="table table-striped table-bordered">';
		print '<form method="post" action="list_branch.php"';
		print '<tr><th>id</th><th>商品名</th><th>値段</th><th>内容</th><th>コメント</th><th>更新</th><th>削除</th></tr>';
		foreach ($items as $value) {
			print '<tr><td>' . $value['id'] . '</td>
	<td>' . $value['name'] . '</td>
	<td>' . $value['price'] . '</td>
	<td>' . $value['contents'] . '</td>
	<td>' . $value['comment'] . '</td>
	<td><input type="radio" name="id_radio" value="' . $value['id'] . '"></td>
	<td><input type="checkbox" name="id_check[]" value="' . $value['id'] . '"></td>
</tr>';
		}
		print '</table>';
		print '<input type="submit" name="reload" value="変更">';
		print '<input type="submit" name="delete" value="削除">';
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