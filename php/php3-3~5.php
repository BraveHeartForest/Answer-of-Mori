<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP3-(3～5)</title>
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
	print '<h2 class="bg-primary">（３） switch文で複数の値をチェックする</h2>';

	$var = 'C';

	print '<p>$varに' . $var . 'を代入しました。</p>';

	switch ($var) {
		case 'A':
			print '<p>変数varの値はAでした。</p>';
			break;
		case 'B':
			print '<p>変数varの値はBでした。</p>';
			break;
		case 'C':
			print '<p>変数varの値はCでした。</p>';
			break;
		case 'D':
			print '<p>変数varの値はDでした。</p>';
			break;
		case 'E':
			print '<p>変数varの値はEでした。</p>';
			break;
		default:
			print '<p>変数varの値はいずれでもありませんでした。</p>;';
			break;
	}

	print "<pre>

\$var='C';

print'&lt;p&gt;\$varに'.\$var.'を代入しました。&lt;/p&gt;';

switch(\$var){
	case 'A':
		print'&lt;p&gt;変数varの値はAでした。&lt;/p&gt;';
		break;
	case 'B':
		print'&lt;p&gt;変数varの値はBでした。&lt;/p&gt;';
		break;
	case 'C':
		print'&lt;p&gt;変数varの値はCでした。&lt;/p&gt;';
		break;
	case 'D':
		print'&lt;p&gt;変数varの値はDでした。&lt;/p&gt;';
		break;
	case 'E':
		print'&lt;p&gt;変数varの値はEでした。&lt;/p&gt;';
		break;
	default:
		print'&lt;p&gt;変数varの値はいずれでもありませんでした。&lt;/p&gt;';
		break;
}
</pre>";

	print '<h2 class="bg-primary">（４）switchで breakを使用しない場合</h2>';

	$var = 'C';

	print '<p>$varに' . $var . 'を代入しました。</p>';

	switch ($var) {
		case 'A':
			print '<p>変数varの値はAでした。</p>';

		case 'B':
			print '<p>変数varの値はBでした。</p>';

		case 'C':
			print '<p>変数varの値はCでした。</p>';

		case 'D':
			print '<p>変数varの値はDでした。</p>';

		case 'E':
			print '<p>変数varの値はEでした。</p>';

		default:
			print '<p>変数varの値はいずれでもありませんでした。</p>;';
	}

	print "<pre>

\$var='C';

print'&lt;p&gt;\$varに'.\$var.'を代入しました。&lt;/p&gt;';

switch(\$var){
	case 'A':
		print'&lt;p&gt;変数varの値はAでした。&lt;/p&gt;';
		
	case 'B':
		print'&lt;p&gt;変数varの値はBでした。&lt;/p&gt;';
		
	case 'C':
		print'&lt;p&gt;変数varの値はCでした。&lt;/p&gt;';
		
	case 'D':
		print'&lt;p&gt;変数varの値はDでした。&lt;/p&gt;';
		
	case 'E':
		print'&lt;p&gt;変数varの値はEでした。&lt;/p&gt;';
		
	default:
		print'&lt;p&gt;変数varの値はいずれでもありませんでした。&lt;/p&gt;';
		
}
</pre>";
	print '<p>この通り、break;が存在しないと、条件が一致した部分以降は全て表示されます。</p>';
	print '<p>仮説としては、条件が一致しないならばFALSEのままで非表示、<br>
条件が一致したならばTRUEフラグが立ち、<br>
それ以降もTRUEとして扱い、結果として表示されるようになるのではないだろうか。</p>';


	print '<h2 class="bg-primary">（５）「default:」を使用してエラーを出力する</h2>';



	$var = '123';

	print '<p>$varに' . $var . 'を代入しました。</p><span class="text-muted">(3)の内容を流用します。</span>';

	switch ($var) {
		case 'A':
			print '<p>変数varの値はAでした。</p>';
			break;
		case 'B':
			print '<p>変数varの値はBでした。</p>';
			break;
		case 'C':
			print '<p>変数varの値はCでした。</p>';
			break;
		case 'D':
			print '<p>変数varの値はDでした。</p>';
			break;
		case 'E':
			print '<p>変数varの値はEでした。</p>';
			break;
		default:
			print '<p>変数varの値はいずれでもありませんでした。</p>;';
			break;
	}




	?>
</body>

</html>