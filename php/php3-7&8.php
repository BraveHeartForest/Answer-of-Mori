<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP3-(7&8)</title>
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
	print '<h1 class="bg-primary">（７） whileループで10まで数える例</h1>';
	$int = 1;
	print '<p>$int = ' . $int . '</p>';
	while ($int < 11) {
		print '<p class="text-center">' . $int . '</p>';
		$int++;
	}

	/*同一の内容が出力されるのでコメントアウトします。
$int=1;
print'<p>$int = '.$int.'</p>';
while($int<11){
	print $int.'<br>';
	++$int;
}
*/
	print '<h1 class="bg-primary">（８） do～whileで10まで数える例</h1>';
	$int = 1;
	do {
		print '<p class="text-center">' . $int . '</p>';
		$int++;
	} while ($int < 11);

	print "<pre>


print'&lt;h1 class=&quot;bg-primary&quot;&gt;（７） whileループで10まで数える例&lt;/h1&gt;';
\$int=1;
print'&lt;p&gt;\$int = '.\$int.'&lt;/p&gt;';
while(\$int&lt;11){
	print '&lt;p class=&quot;text-center&quot;&gt;'.\$int.'&lt;/p&gt;';
	\$int++;
}


print'&lt;h1 class=&quot;bg-primary&quot;&gt;（８） do～whileで10まで数える例&lt;/h1&gt;';
\$int=1;
do{
	print '&lt;p class=&quot;text-center&quot;&gt;'.\$int.'&lt;/p&gt;';
	\$int++;
} while(\$int&lt;11)



</pre>";

	?>
</body>

</html>