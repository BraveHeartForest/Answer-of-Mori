<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(2)</title>
	<!--CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--自作CSS-->
	<style type="text/css">
		p {
			text-align: center;
		}


		h1 {
			text-align: center;
		}

		h2 {
			text-align: center;
		}

		h3 {
			text-align: center;
		}
	</style>
</head>

<body>
	<?php
	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print"<p></p>";
print'<p></p>';
*/

	print '<h1 class="bg-primary">文字列と文字列を結合する。</h1>';
	$str1 = "sample";
	print '<p>$str1="sample";</p>';
	print "<p>$str1</p>";
	$str1 = "sample" . "サンプル";
	print '<p>$str1="sample"."サンプル";</p>';
	print "<p>$str1</p>";

	print '<h1 class="bg-primary">文字列と変数を結合する。</h1>';
	print "<p>$str1</p>";
	$str2 = $str1 . "文字列";
	print '<p>$str2=$str1."文字列";</p>';
	print "<p>$str2</p>";
	print '<h1 class="bg-primary">変数と変数を結合する。</h1>';
	$str3 = $str1 . $str2;
	print '<p>$str3=$str1.$str2;</p>';
	print "<p>$str3</p>";
	?>
</body>

</html>