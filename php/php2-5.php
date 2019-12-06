<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP2-(5)</title>
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


	print '<h2 class="bg-success">（５） 配列の内容をsort関数でアルファベット順に並べる</h2>';

	print '<pre>


$zatta=array(
"ISO 3166-2",
"Madison Hubbell",
"嵐のち晴れ",
"ん",
"地方公営企業法",
"THE WAR THAT WILL END WAR",
"ウェブドットコムツアー",
"Elena Bovina",
"trope",
"0",
"The Thin Man",
"Alex O\'Loughlin",
"reportage",
"1",
"George Nicoll Barnes"
);
//Wikipediaお任せ表示から。

$kosu = count($zatta);

for($i=0;$i<$kosu;$i++){
	print $zatta[$i]."<改行>\n";
}

print"<見出し2 class="bg-success">以下でsort後の配列を順番に表示<見出し２閉じ>";

sort($zatta);

for($i=0;$i<$kosu;$i++){
	print $zatta[$i]."<改行>\n";
}

</pre>';



	$zatta = array(
		"ISO 3166-2",
		"Madison Hubbell",
		"嵐のち晴れ",
		"ん",
		"地方公営企業法",
		"THE WAR THAT WILL END WAR",
		"ウェブドットコムツアー",
		"Elena Bovina",
		"trope",
		"0",
		"The Thin Man",
		"Alex O\'Loughlin",
		"reportage",
		"1",
		"George Nicoll Barnes"
	);
	//Wikipediaお任せ表示から。

	$kosu = count($zatta);

	for ($i = 0; $i < $kosu; $i++) {
		print $zatta[$i] . "<br>\n";
	}

	print '<h2 class="bg-success">以下でsort後の配列を順番に表示</h2>';

	sort($zatta);

	for ($i = 0; $i < $kosu; $i++) {
		print $zatta[$i] . "<br>\n";
	}

	print '<h3 class="bg-info">以上の結果から<br>
（数値→アルファベット→ひらがな→カタカナ→漢字)<br>
の順番で並び替えが行われることが判明した。
</h3>';

	?>
</body>

</html>