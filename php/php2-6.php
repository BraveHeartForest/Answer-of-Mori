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

		.kyoutyou {
			font-weight: bolder;
			color: crimson;
			border-bottom: dashed #384d98;
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


	print '<h1 class="bg-primary">
（６） 多次元配列を作成し（以前の多次元配列を活用）、foreachで内容表示する
</h1>';
	print '<h2 class="bg-success">
さらにwhileで表示するように変更する。
</h2>';
	print '
<p class="bg-info">
そもそも多次元配列とは――<span class="kyoutyou">配列を要素として持つ配列です。</span>
</p>
';
	$gojuon = array();	//初期化。

	$gojuon = array(

		array('あ', 'い', 'う', 'え', 'お'),
		array('か', 'き', 'く', 'け', 'こ'),
		array('さ', 'し', 'す', 'せ', 'そ'),
		array('た', 'ち', 'つ', 'て', 'と'),
		array('な', 'に', 'ぬ', 'ね', 'の'),
		array('は', 'ひ', 'ふ', 'へ', 'ほ'),
		array('ま', 'み', 'む', 'め', 'も'),
		array('や', 'ゆ', 'よ'),
		array('ら', 'り', 'る', 'れ', 'ろ'),
		array('わ', 'を', 'ん')
	);


	foreach ($gojuon as $array) {
		print "-------1回目-------<br>\n";
		foreach ($array as $key => $value) {
			print "<p>key:{$key} value:{$value}</p>";
		}
	}


	$gojuon = array();	//初期化しました。

	$kana_a = array('あ', 'い', 'う', 'え', 'お');
	$kana_k = array('か', 'き', 'く', 'け', 'こ');
	$kana_s = array('さ', 'し', 'す', 'せ', 'そ');
	$kana_t = array('た', 'ち', 'つ', 'て', 'と');
	$kana_n = array('な', 'に', 'ぬ', 'ね', 'の');
	$kana_h = array('は', 'ひ', 'ふ', 'へ', 'ほ');
	$kana_m = array('ま', 'み', 'む', 'め', 'も');
	$kana_y = array('や', '', 'ゆ', '', 'よ');
	$kana_r = array('ら', 'り', 'る', 'れ', 'ろ');
	$kana_w = array('わ', '', 'を', '', 'ん');

	$gojuon = array($kana_a, $kana_k, $kana_t, $kana_n, $kana_h, $kana_m, $kana_y, $kana_r, $kana_w);

	foreach ($gojuon as $array) {
		print "-------2回目-------<br>\n";
		foreach ($array as $key => $value) {
			print "<p>key:{$key} value:{$value}</p>";
		}
	}

	$count = count($gojuon);	//値は9です。


	$i = 0;
	$j = 0;

	while ($i < $count) {
		print $gojuon[$i][$j];
		$j = $j + 1;
		if ($j == 5) {
			$i = $i + 1;
			$j = 0;
			print '<br>';
		}
	}	//for文との違いがよく分からない。while()の中身が関数でも良い？　foreachは多次元配列or連想配列を開くのに特化している？


	/*unsetで削除しても詰められない＆unsetでは多次元配列の要素を一つずつ削除できない。
while($count > 0){
	if($count > 0){
		$count = count($gojuon);
		print $gojuon[0][0];
		unset($gojuon[0][0]);
	}

}
*/
	?>
</body>

</html>