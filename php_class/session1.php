<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP_SESSION(4)~(7)</title>
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

	print '<h2 class="bg-success">(4)セッションを開始するコードを書きなさい。</h2>';



	print $_COOKIE['PHPSESSID'];

	print "<pre>
session_start();

print \$_COOKIE['PHPSESSID'];
</pre>";


	print '<h2 class="bg-success">(5)変数を$_SESSIONで登録する。</h2>';

	if (!isset($_SESSION['visited'])) {	//visitedが存在しないならば
		print '<p>初回の訪問です。セッションを開始します。</p>';


		$_SESSION['visited'] = 1;
		$_SESSION['date'] = date('c');
	} else {

		$visited = $_SESSION['visited'];
		$visited++;

		print '<p>訪問回数は' . $visited . 'です。</p>';

		$_SESSION['visited'] = $visited;

		if (isset($_SESSION['date'])) {
			print '<p>前回の訪問日時は' . $_SESSION['date'] . 'です。</p>';
		}

		$_SESSION['date'] = date('c');
	}


	print "<pre>
if(!isset(\$_SESSION['visited'])){	//visitedが存在しないならば
	print '&lt;p&gt;初回の訪問です。セッションを開始します。&lt;/p&gt;';


	\$_SESSION['visited'] = 1;
	\$_SESSION['date'] = date('c');

	}else{

	\$visited = \$_SESSION['visited'];
	\$visited++;

	print '&lt;p&gt;訪問回数は'.\$visited.'です。&lt;/p&gt;';

	\$_SESSION['visited'] = \$visited;

	if(isset(\$_SESSION['date'])){
		print '&lt;p&gt;前回の訪問日時は'.\$_SESSION['date'].'です。&lt;/p&gt;';
	}

	\$_SESSION['date'] = date('c');
}
</pre>";


	print '<h2 class="bg-success">(6)セッション継続中に前のページで格納されたセッション変数を参照する。</h2>';


	print '<form method="post" action="./session2.php">';
	print '<p>ユーザー名を入力してください。</p>';
	print '<input type="text" name="username">';
	print '<input type="submit" value="送信">';
	print '</form>';

	print "
<pre>
print'&lt;form method=&quot;post&quot; action=&quot;./session2.php&quot;&gt;';
print'&lt;p&gt;ユーザー名を入力してください。&lt;/p&gt;';
print'&lt;input type=&quot;text&quot; name=&quot;username&quot;&gt;';
print'&lt;input type=&quot;submit&quot; value=&quot;送信&quot;&gt;';
print'&lt;/form&gt;';
</pre>
";



	?>
</body>

</html>