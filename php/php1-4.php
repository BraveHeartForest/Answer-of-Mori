<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(4)</title>
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
print'<p></p>';
print"<p></p>";
*/

	define('TAX2019', 1.1);	//2019年10月からの消費税です。

	$price = 398;	//価格398のものは……

	print "<p>define('TAX2019',1.1);	//2019年10月からの消費税です。</p>";
	print '<p>$price=398;	//価格398のものは……</p>';


	print '<p>税抜' . $price . '円の物は2019年10月からは</p>';

	print '<p>税込' . $price * TAX2019 . '円です。</p>';

	print '<p>' . $price * tax2019 . '</p>';
	print '<p>上の行ではTAX2019ではなくtax2019と書いて税込の式を計算させました。</p>';

	define('Howdy', 'やあ！', true);
	print "<p>define('Howdy','やあ！',true);と言う形でtrueを入れると大文字と小文字の区別をしなくなります。</p>";
	print "howdy Howdy HOWdY<br>";
	print howdy;
	print Howdy;
	print HOWdY;

	define('Howdy', 'よっす！', true);
	print "<p>define('Howdy','よっす！',true);というように書き換えようとしても上のように無駄に終わります。</p>";


	const ANIMAL = array('犬', '猿', '雉');

	print '桃太郎のお供は' . ANIMAL[0] . ',' . ANIMAL[1] . ',' . ANIMAL[2] . 'です。';

	const ANIMAL = '動物';
	print '<br><br>';

	print ANIMAL . 'の森';

	for ($i = 0; $i < 3; $i++) {
		print '<br>' . ANIMAL[$i];
	}

	?>
</body>

</html>