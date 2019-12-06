<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) == true) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();

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



    print '<h2 class="bg-success">(7)セッションの破棄をする。</h2>';

    print "
&lt;?php	setcookie命令より前に画面表示があってはいけない、というルールがあるので、&lt;html&gt;よりも前に存在します。<br>
session_start();<br>
\$_SESSION = array();	セッション変数（秘密文書）を空っぽにする。<br>
if(isset(\$_COOKIE[session_name()]) == true)<br>
{<br>
	setcookie(session_name(),'',time-42000,'/');	「もしクッキー情報があるのなら」パソコン側のセッションID（合言葉）をクッキーから削除する。<br>
}<br>
session_destory();	セッションを破棄する（サーバーとユーザーのPCの関係を断ち切る）<br>
?&gt;<br>

";

    print "<pre>
&lt;?php
session_start();
\$_SESSION = array();
if(isset(\$_COOKIE[session_name()]) == true)
{
	setcookie(session_name(),'',time-42000,'/');
}
session_destory();
?&gt;
</pre>";

    print '<p>セッションの破棄がされたはずなので以下でそれを確認します。</p>';


    print('セッション変数の確認をします。<br>');
    if (!isset($_SESSION["visited"])) {
        print('セッション変数visitedは登録されていません。<br>');
    } else {
        print($_SESSION["visited"] . '<br>');
    }

    print('セッションIDの確認をします。<br>');
    if (!isset($_COOKIE["PHPSESSID"])) {
        print('セッションは登録されていません。<br>');
    } else {
        print($_COOKIE["PHPSESSID"] . '<br>');
    }



    ?>
</body>

</html>