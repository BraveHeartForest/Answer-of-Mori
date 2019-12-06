<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP2-(3)</title>
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

	print '<h2 class="bg-success">
（３） else文とif文<br>
以下の文で<br>
①trueが実行されるには、また<br>
②falseが実行されるには、どうすればいいですか？
</h2>';
	print '<pre>
if ($username == "Admin"){
    echo ("Welcome to the admin page.");
}
else {
    echo ("Welcome to the user page.");
}
</pre>
';
	print '<h3 class="bg-info">以下は解答者による答え</h3>';
	print '<p>
変数$usernameが定義されていないといけないので、それを定義する。
</p>';



	$username = "admin";
	print '<p class="text-danger"><b>$username = "admin";とする。</b></p>';
	if ($username == "Admin") {
		echo ("Welcome to the <b>admin</b> page.");
	} else {
		echo ("Welcome to the <b>user</b> page.");
	}


	$username = "Admin";
	print '<p class="text-danger"><b>$username = "Admin";とする。</b></p>';
	if ($username == "Admin") {
		echo ("Welcome to the <b>admin</b> page.");
	} else {
		echo ("Welcome to the <b>user</b> page.");
	}


	?>
</body>

</html>