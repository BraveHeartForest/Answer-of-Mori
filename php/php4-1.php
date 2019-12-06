<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP4-(1)</title>
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

print"<p></p>";
*/

	print '<h1 class="bg-primary">（１） arrayを使用して平日の配列を作成する</h1>';
	print '<p>何が言いたいのかよく分からないので、日曜以外の曜日を配列とする。</p>';

	$heijitu = array(
		'月曜日',
		'火曜日',
		'水曜日',
		'木曜日',
		'金曜日',
		'土曜日'
	);

	print '<p class="text-danger">日曜日に市場に出掛け</p>';
	print '<p class="text-danger">糸と麻を買ってきた</p>';
	print '<p class="text-danger">テュリャテュリャテュリャテュリャテュリャテュリャリャ</p>';
	print '<p class="text-danger">テュリャテュリャテュリャテュリャリャリャー</p>';
	print '<p class="text-danger">' . $heijitu[0] . 'にお風呂をたいて</p>';
	print '<p class="text-danger">' . $heijitu[1] . 'にお風呂に入り</p>';
	print '<p class="text-danger">' . $heijitu[2] . 'に友達が来て</p>';
	print '<p class="text-danger">' . $heijitu[3] . 'に送っていった</p>';
	print '<p class="text-danger">' . $heijitu[4] . 'は糸巻きもせず</p>';
	print '<p class="text-danger">' . $heijitu[5] . 'はおしゃべりばかり</p>';
	print '<p class="text-danger">恋人よこれが私の一週間の仕事です</p>';
	print '<p class="text-danger">テュリャテュリャテュリャテュリャテュリャテュリャリャ</p>';
	print '<p class="text-danger">テュリャテュリャテュリャテュリャリャリャー</p>';

	print "<pre>
print'&lt;p class=&quot;text-danger&quot;&gt;日曜日に市場に出掛け&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;糸と麻を買ってきた&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;テュリャテュリャテュリャテュリャテュリャテュリャリャ&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;テュリャテュリャテュリャテュリャリャリャー&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;'.\$heijitu[0].'にお風呂をたいて&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;'.\$heijitu[1].'にお風呂に入り&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;'.\$heijitu[2].'に友達が来て&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;'.\$heijitu[3].'に送っていった&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;'.\$heijitu[4].'は糸巻きもせず&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;'.\$heijitu[5].'はおしゃべりばかり&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;恋人よこれが私の一週間の仕事です&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;テュリャテュリャテュリャテュリャテュリャテュリャリャ&lt;/p&gt;';
print'&lt;p class=&quot;text-danger&quot;&gt;テュリャテュリャテュリャテュリャリャリャー&lt;/p&gt;';
</pre>";
	?>
</body>

</html>