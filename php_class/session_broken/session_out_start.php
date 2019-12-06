<?pphp
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


h1 {

}
h2 {

}
h3 {

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



print'<h2 class="bg-success">(7)セッションの破棄をする。(<b>確認</b>)</h2>';


    print('セッション変数の一覧を表示します。<br>');
    print_r($_SESSION);
    print('<br>');

    print('セッションIDを表示します。<br>');
    print($_COOKIE["PHPSESSID"].'<br>');

    print('<p>ログアウトします</p>');

    $_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

    session_destroy();


print"<pre>
print'&lt;p&gt;セッション変数の一覧を表示します。&lt;/p&gt;';

print_r(\$_SESSION);
print'&lt;br&gt;';

print'&lt;p&gt;セッションIDを表示します。&lt;/p&gt;';

print \$_COOKIE['PHPSESSID'].'&lt;br&gt;';

print'&lt;p&gt;ログアウトします。&lt;/p&gt;';

\$_SESSION = array();

if(isset(\$_COOKIE['PHPSESSID'])){
	setcookie('PHPSESSID','',time()-4800,'/');
}

session_destroy();
</pre>";


print'<a href="./session_out_end.php"><button type="button" class="btn btn-danger">ログアウトの確認。</button></a>';

?>
</body>
</html>

