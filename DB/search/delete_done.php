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




		$conn = new Connect();

		for ($i = 0; $i < $count; $i++) {
			$data = array();
			$data[] = $checked[$i];
			$sql = "DELETE FROM menu WHERE id = ?";
			$stmt = $conn->plural($sql, $data);
		}


		unset($_SESSION);
		session_destroy();
		print '<p>データを削除しました。</p>';
		print '<a href="menu.php"><button class="btn btn-success">検索メニューに戻る。</button></a>';
		print '<br>';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	} catch (Exception $e) {
		print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
		print '<a href="menu.php"><button class="btn btn-success">検索メニューに戻る。</button></a>';
		print '<br>';
		print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
	}
	?>
</body>

</html>