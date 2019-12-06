<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP4-(3)</title>
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

	print '<h1 class="bg-primary">（３） 配列から1つの値を表示</h1>';

	$renso = array();	//初期化します。

	$renso = array(
		'顔' => '円形',
		'目' => 'ラグビーボール',
		'鼻' => '三角形',
		'コーヒーカップ' => 'ドーナツ',
		'サイコロ' => '立方体',
		'ペットボトル' => '円筒',
		'ティッシュ箱' => '長方形',
		'踏み台' => '台形',
		'マンホール' => '定幅図形',
	);

	print '<p>' . $renso['顔'] . '</p>';
	print '<p>' . $renso['目'] . '</p>';
	print '<p>' . $renso['鼻'] . '</p>';
	print '<p>' . $renso['コーヒーカップ'] . '</p>';
	print '<p>' . $renso['サイコロ'] . '</p>';
	print '<p>' . $renso['ペットボトル'] . '</p>';
	print '<p>' . $renso['ティッシュ箱'] . '</p>';
	print '<p>' . $renso['踏み台'] . '</p>';
	print '<p>' . $renso['マンホール'] . '</p>';


	print "<pre>
print '&lt;p&gt;'.\$renso['顔].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['目].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['鼻].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['コーヒーカップ].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['サイコロ].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['ペットボトル].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['ティッシュ箱].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['踏み台].'&lt;/p&gt;';
print '&lt;p&gt;'.\$renso['マンホール].'&lt;/p&gt;';
</pre>";

	print '<h2 class="bg-success">もう既に一つの値を表示することは出来ていると思います。</h2>';

	print_r($renso);
	print "<p>↑はprint_rで表示する方法。</p>";

	var_dump($renso);
	print "<p>↑はvar_dumpで表示する方法。</p>";

	print '<h1 class="bg-primary">（４） 配列の要素を数える</h1>';
	$count = count($renso);
	print '連想配列$rensoの要素の個数は' . $count . 'です。';
	print '<p>配列の要素を数えるのはcount関数です。</p>';


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

	print '<p>多次元配列$gojuonの個数を数える方法は二通り。</p>';
	print '<p>第2引数を省略した。count($gojuon)と</p>';
	print '<p>第2引数に1を指定したcount($gojuon,1)で、それぞれを実行すると</p>';
	print count($gojuon) . '<br>';
	print count($gojuon, 1);
	print '<p>のようになります。</p>';
	print '<p>count($gojuon,1)=56となるのは五十音(46個)+あかさたなはまやらわ(10個)の結果です。</p>';
	?>
</body>

</html>