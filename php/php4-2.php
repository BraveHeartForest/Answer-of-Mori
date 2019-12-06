<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP4-(2)</title>
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

	print '<h1 class="bg-primary">（２） 形に関する連想配列の作成</h1>';

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


	?>
</body>

</html>