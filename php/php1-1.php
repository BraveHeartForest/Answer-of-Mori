<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(1)</title>
	<!--CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--自作CSS-->
	<style type="text/css"><!--
p {
	text-align: center;
}

h2 {
	text-align: center;
}

h3 {
	text-align: center;
}
li {
	text-align: center;
}
</style>
</head>
<body>

<?php

print '<p class="text-center">strcasecmpを調べて、かつ使用して二つの文字列を比較する。</p>';
print '<p>ifで文字列結果を分けて表示する。</p>';
print '<h3 class="text-primary">説明</h3>';
print '<p>strcasecmp(string $str1,string $str2) : int</p>';
print '<p>大文字小文字を区別しないバイナリセーフな文字列比較を行います。</p>';
print '<h3 class="text-primary">パラメータ</h3>';
print '<ul class="list-unstyled">
	<li class="text-danger">str1</li>
	<li>最初の文字列</li>
	<li class="text-danger">str2</li>
	<li>次の文字列</li>
	</ul>';

print '<h3 class="text-primary">返り値</h3>';
print '<p>str1&lt;str2ならば&lt;0、str1&gt;str2ならば&gt;0、str1=str2ならば=0を返します。</p>';
print "<p>str1='Hello &#92;x00 Mr.Gorilla!',str2='Hello Mr.Gorilla!'を代入して以下で試す。</p>";
$str1 = 'Hello \x00 Mr.Gorilla!';
$str2 = 'Hello Mr.Gorilla!';
print '<h2>' . "$str1" . '</h2>';
print '<h2>' . "$str2" . '</h2>';

if (strcasecmp($str1, $str2) == 0) {
	print '<p>$str1と$str2は同一文字列です。</p>';
} else {
	if (strcasecmp($str1, $str2) > 0) {
		print '<p>$str1と$str2では$str1の文字列の方が長いです。</p>';
	} else {
		print '<p>$str1と$str2では$str2の文字列の方が長いです。</p>';
	}
}

$str1 = 'Hello';
$str2 = 'Hello';

print '<h2>' . "$str1" . '</h2>';
print '<h2>' . "$str2" . '</h2>';

if (strcasecmp($str1, $str2) == 0) {
	print '<p>$str1と$str2は同一文字列です。</p>';
} else {
	if (strcasecmp($str1, $str2) > 0) {
		print '<p>$str1と$str2では$str1の文字列の方が長いです。</p>';
	} else {
		print '<p>$str1と$str2では$str2の文字列の方が長いです。</p>';
	}
}
$str1 = 'HeLlO';

print '<h2>' . "$str1" . '</h2>';
print '<h2>' . "$str2" . '</h2>';

if (strcasecmp($str1, $str2) == 0) {
	print '<p>$str1と$str2は同一文字列です。</p>';
} else {
	if (strcasecmp($str1, $str2) > 0) {
		print '<p>$str1と$str2では$str1の文字列の方が長いです。</p>';
	} else {
		print '<p>$str1と$str2では$str2の文字列の方が長いです。</p>';
	}
}
$str1 = 'abc';
$str2 = 'def';
print '<h2>' . "$str1" . '</h2>';
print '<h2>' . "$str2" . '</h2>';

if (strcasecmp($str1, $str2) == 0) {
	print '<p>$str1と$str2は同一文字列です。</p>';
} else {
	if (strcasecmp($str1, $str2) > 0) {
		print '<p>$str1と$str2では$str1の文字列の方が長いです。</p>';
	} else {
		print '<p>$str1と$str2では$str2の文字列の方が長いです。</p>';
	}
}

print '<blockquote><p class="text-danger">バイナリセーフな関数</p><footer><cite>バイナリデータを正しく扱うことができる関数</cite></footer></blockquote>';
print '<blockquote><p class="text-danger">バイナリセーフでない関数</p><footer><cite>バイナリデータを正しく扱うことができない関数</cite></footer></blockquote>';
print '<blockquote><p class="text-danger">バイナリデータ</p><footer><cite>コンピュータが扱えるよう2進法に則って0と1の羅列として表現されたデータの内、テキスト形式でない任意のデータ形式のこと。</cite></footer></blockquote>';
print '<p>バイナリセーフでない関数を使用するとNULLバイト攻撃にあう。</p>';
print '<h1 class="text-center"><b>Nullバイト攻撃とは……</b></h1>';
print '<p>nullバイト(「&#92;0」、「&#92;x00」などの終端文字とされている文字列）を含めることでセキュリティチェックを潜り抜けてしまう。</p>';
print '<p></p>';




?>
</body>
</html>