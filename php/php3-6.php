<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
<title>PHP3-(3)</title>
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
<div class="container-fluid">
<?php $str='what'; ?>
<p>
<?php switch($str) : ?>
<?php case('how') : ?>How<?php break; ?>
<?php case('who') : ?>Who<?php break; ?>
<?php case('what') : ?>What<?php break; ?>
<?php case('why') : ?>Why<?php break; ?>
<?php case('where') : ?>Where<?php break; ?>
<?php case('when') : ?>When<?php break; ?>
<?php endswitch; ?>
</p>
<pre>
&lt;p&gt;
&lt;?php switch($str) : ?&gt;
&lt;?php case('how') : ?&gt;How&lt;?php break; ?&gt;
&lt;?php case('who') : ?&gt;Who&lt;?php break; ?&gt;
&lt;?php case('what') : ?&gt;What&lt;?php break; ?&gt;
&lt;?php case('why') : ?&gt;Why&lt;?php break; ?&gt;
&lt;?php case('where') : ?&gt;Where&lt;?php break; ?&gt;
&lt;?php case('when') : ?&gt;When&lt;?php break; ?&gt;
&lt;?php endswitch; ?&gt;
&lt;/p&gt;
</pre>
</div>
</body>
</html>

