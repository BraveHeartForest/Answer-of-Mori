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


h1 {

}
h2 {

}
h3 {

}
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


require_once("../funCLASS/function.php");
require_once("../funCLASS/classSQL.php");


print'<form method="post" action="checkbox2.php">';
print'<input type="checkbox" name="c[]" value="A">A<br>';
print'<input type="checkbox" name="c[]" value="B">B<br>';
print'<input type="checkbox" name="c[]" value="C">C<br>';
print'<input type="checkbox" name="c[]" value="D">D<br>';
print'<input type="checkbox" name="c[]" value="E">E<br>';
print'<input type="checkbox" name="c[]" value="F">F<br>';

print'<input type="submit" value="送信">';
print'</form>';


print'<br>';
print'<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
?>
</body>
</html>

