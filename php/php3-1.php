<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP3-(1)</title>
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
print'<p><h1 class="bg-primary"></h1>';
print'<p><h2 class="bg-success"></h2>';
print'<p><h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/
	print '<p><h1 class="bg-primary">（１） 複数条件のチェック</h1>';
	print '<p><h2 class="bg-success">if　elseif　elseでelseifがtrueになるプログラムを作成</h2>';

	$var = 100;

	if ($var >= 1000) {
		print '<p>変数varは1000以上です。</p>';
	} else if ($var >= 0) {
		print '<p>変数varは0以上1000以下です。</p>';
	} else {
		print '<p>変数varは0未満です。</p>';
	}

	print "<pre>
\$var=100;

if(\$var>=1000){
	print'&lt;p&gt;変数varは1000以上です。&lt;/p&gt;';
	}else if(\$var>=0){
		print'&lt;p&gt;変数varは0以上1000以下です。&lt;/p&gt;';
	}else{
		print'&lt;p&gt;変数varは0未満です。&lt;/p&gt;';
}


</pre>";

	?>
</body>

</html>