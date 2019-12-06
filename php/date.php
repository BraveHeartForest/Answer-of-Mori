<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>PHP1-(4)</title>
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
$date = new DateTime();
print $date->format("Y年n月j日 A g時i分")."<br>";
print $date->format("y/m/d H:i")."<br>";
print $date->format(DATE_COOKIE);

print'<table class="table table-bordered">';
print'<tr>';
	print'<th>フォーマット文字</th>';
	print'<th>意味</th>';
	print'<th>例、範囲</th>';
print'</tr>';
print'<tr>';
	print'<th>Y</th>';
	print'<td>四桁の数字</td>';
	print'<td>1999や2009など</td>';
print'</tr>';
print'<tr>';
	print'<th>y</th>';
	print'<td>二桁の数字</td>';
	print'<td>99や09など</td>';
print'</tr>';
print'<tr>';
	print'<th>m</th>';
	print'<td>二桁の数字一桁の場合は先頭に0を付ける</td>';
	print'<td>01,12など</td>';
print'</tr>';
print'<tr>';
	print'<th>n</th>';
	print'<td>数字、一桁の場合は0を先頭に付けない</td>';
	print'<td>1,2,3,4...</td>';
print'</tr>';
print'<tr>';
	print'<th>M</th>';
	print'<td>月を表す三文字の文字列</td>';
	print'<td>JanからDec</td>';
print'</tr>';
print'<tr>';
	print'<th>d</th>';
	print'<td>二桁の数字一桁の場合は先頭に0を付ける</td>';
	print'<td>01~31</td>';
print'</tr>';
print'<tr>';
	print'<th>j</th>';
	print'<td>数字一桁の場合は先頭に0を付けない</td>';
	print'<td>1~31</td>';
print'</tr>';
print'<tr>';
	print'<th>N</th>';
	print'<td>ISO-8601形式の曜日を表す数値</td>';
	print'<td>1~7</td>';
print'</tr>';
print'<tr>';
	print'<th>D</th>';
	print'<td>曜日を表す三文字の文字列</td>';
	print'<td>Man,Fri</td>';
print'</tr>';
print'<tr>';
	print'<th>a</th>';
	print'<td>午前、午後を表す</td>';
	print'<td>am,pm</td>';
print'</tr>';
print'<tr>';
	print'<th>H</th>';
	print'<td>二桁の数字、24時間単位</td>';
	print'<td>00~23</td>';
print'</tr>';
print'<tr>';
	print'<th>g</th>';
	print'<td>数字、一桁の場合は先頭に0を付けない。12時間単位</td>';
	print'<td>1~12</td>';
print'</tr>';
print'<tr>';
	print'<th>i</th>';
	print'<td>二桁の数字一桁の場合は先頭に0を付ける</td>';
	print'<td>00~59</td>';
print'</tr>';
print'<tr>';
	print'<th>s</th>';
	print'<td>二桁の数字一桁の場合は先頭に0を付ける</td>';
	print'<td>00~59</td>';
print'</tr>';

print'</table>';


	?>
</body>

</html>