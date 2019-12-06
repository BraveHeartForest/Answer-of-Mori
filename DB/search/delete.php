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

		session_start();
		session_regenerate_id(true);

		//session_destroy();


		$checked = sanitize($_SESSION['checked']);


		/*
foreach($checked as $value){
	$data[] = (int)$value;
}	//配列の要素を整数に変更します。
*/

		$count = count($checked);



		if (empty($_SESSION['checked'])) {	//何かしらチェックされている。

			print '<p class="bg-info text-danger">何も選択されていません。</p>';
			print '<form>';
			print '<input type="button" onclick="history.back()" value="戻る">';
			print '</form>';
			print '<br>';
			print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
		} else {


			$conn = new Connect();

			for ($i = 0; $i < $count; $i++) {
				$data = array();
				$data[] = $checked[$i];
				$sql = "SELECT * FROM menu WHERE id = ?";
				$stmt = $conn->plural($sql, $data);

				foreach ($stmt as $value) {
					$id = $value['id'];
					$name = $value['name'];
					$price = $value['price'];
					$contents = $value['contents'];
					$comment = $value['comment'];
				}
				?>

				<table class="table table-bordered table-condensed">
					<tr>
						<th>id</th>
						<td><?= $id ?></td>
					</tr>
					<tr>
						<th>name</th>
						<td><?= $name ?></td>
					</tr>
					<tr>
						<th>price</th>
						<td><?= $price ?></td>
					</tr>
					<tr>
						<th>contents</th>
						<td><?= $contents ?></td>
					</tr>
					<tr>
						<th>comment</th>
						<td><?= $comment ?></td>
					</tr>
				</table>
				<br>
			<?php
			}

			print '<p>以上のデータを削除してもよろしいですか。</p>';
			print '<form action="delete_done.php">';
			print '<input type="submit" value="削除"><br>';
			print '<input type="button" onclick="history.back()" value="戻る">';
		}
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}
	?>
</body>

</html>