<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP2-(1)</title>
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

	print '<h1 class="bg-primary text-nowrap">(1)以下の式の答えをまず考えて、プログラムで確認</h1>';
	print '
<p><b>
2+4-5<br>
4-5+2<br><br>
4*5/2<br>
5/2*4<br>
</b></p>
';

	print '<p class="text-danger">以下は解答者による答え</p>';
	print '
<p>
2+4-5 = 6-5 = 1<br>
4-5+2 = -1+2 = 1<br><br>
4*5/2 = 4&times;5&divide;2 = 20&divide;2 = 10<br>
5/2*4 = 5&divide;2&times;4 = 2.5&times;4 =10
</p>
';
	$ans1 = 2 + 4 - 5;
	$ans2 = 4 - 5 + 2;
	$ans3 = 4 * 5 / 2;
	$ans4 = 5 / 2 * 4;

	print '<p class="text-success">以下はプログラミングによる答え</p>';
	print "
<p>
2+4-5 = $ans1<br>
4-5+2 = $ans2<br><br>
4*5/2 = $ans3<br>
5/2*4 = $ans4<br>
</p>
";

	print '<h1 class="bg-primary text-nowrap">(2)以下の式の答えをまず考えて、プログラムで確認</h1>';

	print '
<p ><b>
2*3+4+1<br>
2*(3+4+1)
</b></p>
';

	print '<p class="text-danger">以下は解答者による答え</p>';
	print '
<p>
2*3+4+1 = 6+4+1 =11<br>
2*(3+4+1) = 2&times;(3+4+1) = 2&times;8 = 16
</p>
';

	$ans1 = 2 * 3 + 4 + 1;
	$ans2 = 2 * (3 + 4 + 1);

	print '<p class="text-success">以下はプログラミングによる答え</p>';
	print "
<p>
2*3+4+1 = $ans1<br>
2*(3+4+1) = &ans2
</p>
";
	?>
</body>

</html>