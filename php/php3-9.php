<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP3-(9)</title>
	<!--CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--自作CSS-->
	<style type="text/css">
		body {
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
	print '<h1 class="bg-primary">（９）breakを使用して「ゼロ割り」を避ける</h1>';
	print '$counter = -3;<br>
for (; $counter < 10; $counter++){<br>
echo　100/$counter；<br>
}
を実行せよ。但し、見出しの通りに。<br><br>
';

	$counter = -3;
	for (; $counter < 10; $counter++) {
		if ($counter == 0) {
			break;
		}

		print 100 / $counter . '(' . $counter . 'で割った結果です)<br>';
	}

	print "<pre>
\$counter = -3;
for(; \$counter&lt;10; \$counter++){
	if(\$counter==0){
		break;
	}

	print 100/\$counter.'('.\$counter.'で割った結果です)&lt;br&gt;';
}
</pre>";



	print '<h1 class="bg-primary">（１０） breakの代わりにcontinueを使用する</h1>';

	$counter = -3;
	for (; $counter < 10; $counter++) {
		if ($counter == 0) {
			print '0で割ってはいけないのでここは抜かします<br>';
			continue;
		}

		print 100 / $counter . '(' . $counter . 'で割った結果です)<br>';
	}

	print "<pre>
\$counter = -3;
for(; \$counter&lt;10; \$counter++){
	if(\$counter==0){
		print'0で割ってはいけないのでここは抜かします&lt;br&gt;';
		continue;
	}

	print 100/\$counter.'('.\$counter.'で割った結果です)&lt;br&gt;';
}
</pre>";

	?>
</body>

</html>