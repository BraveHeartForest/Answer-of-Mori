<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP5-(1)</title>
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
	include('./function.php');
	/*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/


	$a = 1;
	$b = add1($a);

	echo $a;
	print '<br>';
	echo $b;
	print '<br>';
	print '<br>';

	$b = add2($a);	//関数内部で$a=$a++を行っていて、この内部でも反映されている。

	echo $a;
	print '<br>';
	echo $b;



	print "
<pre>

\$a = 1;
\$b = add1(\$a);

echo \$a;
print'&lt;br&gt;';
echo \$b;
print'&lt;br&gt;';
print'&lt;br&gt;';

\$b = add2(\$a);

echo \$a;
print'&lt;br&gt;';
echo \$b;

________________________________________

function add1 (\$number) {
    return ++\$number;
}


function add2 (&\$number) {    // 「&」を引数につける
    return ++\$number;
}

function modulor(\$int1,\$int2){
if(\$int1&lt;\$int2 || \$int2==0 || \$int2&lt;0){
	print'先に入力する変数の方が大きくなるようにしてください。';
	exit();
}
	\$mod=\$int1 % \$int2;
	while(\$mod&gt;0){
		if(\$mod != 0){
			\$last = \$mod;
		}	//if end
	\$mod = \$int2 % \$mod;
		}// while end
print \$int1.'と'.\$int2.'は'.\$last.'を法として合同である。';
}


\$a=2019;
\$b=789;

modulor(\$a,\$b);

</pre>
";


	$a = 2019;
	$b = 789;

	modulor($a, $b);

	print '<p>"https://qiita.com/kazu56/items/50b35c9ee0e5c6c4e75e"参考サイト（タイプヒンティング）</p>';
	?>
</body>

</html>