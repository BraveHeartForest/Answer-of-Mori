<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(6,7,8,9,10,11)</title>
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

	const CON_NUM	=	300;
	print CON_NUM / 365;
	print '<br>';
	print CON_NUM % 365;
	print '<br><br><br>';
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

	print '干支は順番に';
	for ($i = 0; $i < 12; $i++) {
		print ANIMAL[$i] . '、';
	}
	print 'です。<br><br>';
	print '干支は逆から順番に';
	for ($i = 11; $i >= 0; $i--) {
		print ANIMAL[$i] . '、';
	}
	print 'です。<br><br>';


	print '干支は順番に';
	for ($i = 0; $i < 12; ++$i) {
		print ANIMAL[$i] . '、';
	}
	print 'です。<br><br>';
	print '干支は逆から順番に';
	for ($i = 11; $i >= 0; --$i) {
		print ANIMAL[$i] . '、';
	}
	print 'です。<br><br>';

	print '<h2>以下は全体を通して元の変数の値は5とする。</h2>';


	echo '<h3>後置加算</h3>';
	$a = 5;
	echo '$a++を表示します。' . $a++ . '<br>';
	echo 'その後の$aを表示します。' . $a . '<br>';

	echo '<h3>前置加算</h3>';
	$a = 5;
	echo '++$aを表示します。' . ++$a . '<br>';
	echo 'その後の$aを表示します。' . $a . '<br>';

	echo '<h3>後置減算</h3>';
	$a = 5;
	echo '$a--を表示します。' . $a-- . '<br>';
	echo 'その後の$aを表示します。' . $a . '<br>';

	echo '<h3>前置減算</h3>';
	$a = 5;
	echo '--$aを表示します。' . --$a . '<br>';
	echo 'その後の$aを表示します。' . $a . '<br>';

	$a = 0;
	echo ++$a . " " . $a++ . '<br>';
	echo ++$a . " " . $a++ . '<br>';
	echo ++$a . " " . $a++ . '<br>';
	echo ++$a . " " . $a++ . '<br>';

	$b = 1234;

	print '変数bに数値1234を代入します。<br>
php関数のvar_dump($b)で変数bの型を調べることが出来ます。<br>';
	var_dump($b);
	print '<br><br>';

	print '次にvar_dump((string)$b)を表示します。<br>';
	var_dump((string) $b);
	print '<br><br>';
	print 'もう一度var_dump($b)を表示します。<br>';
	var_dump($b);
	print '<br><br>';
	print '飽くまで一時的に変数の型を変更しただけでした。<br>';

	print '次に$c=(string)$bとしてvar_dump($c)を表示します。<br>';
	$c = (string) $b;
	var_dump($c);
	print '<br><br>';

	print '<h3 class="bg-info">1-（12）の間違いを正してみましょう。</h3>';

	//3=$locations;	間違い1	数値を変数として扱えるようにすると数値が扱えなくなるため。
	//$a+$b=$c;	間違い2	プログラミングでは=は「（左辺）に（右辺）の内容を代入する」であるため（左辺）は一つに定まらないといけない。
	$locations = 3;
	$c = $a + $b;

	var_dump($locations);
	print "<br>\n";
	var_dump($c);


	?>
</body>

</html>