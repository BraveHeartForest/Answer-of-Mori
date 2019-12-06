<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP2-(4)</title>
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

	print '<h2 class="bg-success">（４） ループ処理で配列の内容<br>
（以前作成した配列使用）を表示する
</h2>';

	print '<p class="bg-danger">以前作成した配列使用が不明だが、個人的に作成していたものを利用することにする。</p>';

	print "<pre>
const ANIMAL = array(
	'子',
	'丑',
	'寅',
	'卯',
	'龍',
	'巳',
	'午',
	'未',
	'申',
	'酉',
	'戌',
	'亥'
);

\$cnt = count(ANIMAL);	//配列の要素の数を数える。

print'干支は順番に';
for(\$i=0;\$i&lt;\$cnt;\$i++){
	print ANIMAL[\$i].'、';
}
print'です。&lt;br&gt;&lt;br&gt;';

</pre>";


	const ANIMAL = array(
		'子',
		'丑',
		'寅',
		'卯',
		'龍',
		'巳',
		'午',
		'未',
		'申',
		'酉',
		'戌',
		'亥'
	);

	$cnt = count(ANIMAL);	//配列の要素を数える。

	print '干支は順番に';
	for ($i = 0; $i < $cnt; $i++) {
		print ANIMAL[$i] . '、';
	}
	print 'です。<br><br>';

	?>
</body>

</html>