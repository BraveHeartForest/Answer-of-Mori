﻿<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>CLASS1</title>
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
			class ClassA{
				public static function test(){
					static::who();
				}

				public static function who(){
					print"<h1>".__CLASS__."</h1>";
				}
			}
			class ClassB extends ClassA{
				public static function who(){
					print"<h1>".__CLASS__."</h1>";
				}
			}

			classA::test();
			ClassB::test();

			print'<pre>
			class ClassA{
				public static function test(){
					static::who();
				}

				public function who(){
					print"&lt;h1&gt;".__CLASS__."&lt;/h1&gt;";
				}
			}
			class ClassB extends ClassA{
				public function who(){
					print"&lt;h1&gt;".__CLASS__."&lt;/h1&gt;";
				}
			}

			classA::test();
			ClassB::test();
			</pre>';
	?>
</body>

</html>