<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>DB1</title>
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

	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/

	try {

		//DBへ接続

		$dsn = 'mysql:dbname=brave;host=localhost;charset=utf8';
		$user = 'root';
		$password = '';

		$dbh = new PDO($dsn, $user, $password);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		/*
for($i=0;$i<19;$i++){	//これにて19件を追加することに成功。


$id = $i+1;
$name = chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90)).chr(mt_rand(65,90));
$price = mt_rand(1000,10000);


print'乱数$id='.$id.'<br>';
print'ランダム名前='.$name.'<br>';
print'ランダム価格'.$price.'<br>';


$sql='INSERT INTO menu(id,name,price,contents,comment) VALUES("'.$id.'","'.$name.'","'.$price.'","","")';

$stmt = $dbh->prepare($sql);
$stmt->execute();


}	//for閉じ
*/

		$dbh = null;
	} catch (Exception $e) {

		print $e->getMessage();

		print '<br>何らかの問題で接続できませんでした。';
		exit();
	}

	?>
</body>

</html>