<!DOCTYPE html>
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
			class MyClass{
				private $data = array();

				public function __set($name, $value)
				{
					$this->data[$name] =$value;
				}

				public function __get($name)
				{
					return $this->data[$name];
				}

				public function __isset($name)
				{
					return isset($this->data[$name]);
				}
			}

			$mon = new MyClass();

			//__setが呼び出される。
			$mon->Jan="睦月";
			$mon->Feb="如月";
			$mon->Mar="弥生";

			//__getが呼び出される。
			print "<h1>".$mon->Feb."</h1>";
			print"<br>";

			//__issetが呼び出される
			if(isset($mon->Dec)){
				print"<h2>定義済み</h2>";
			}else{
				print"<h2>未定義</h2>";
			}
			print'<pre>
			class MyClass{
				private $data = array();

				public function __set($name, $value)
				{
					$this->data[$name] =$value;
				}

				public function __get($name)
				{
					return $this->data[$name];
				}

				public function __isset($name)
				{
					return isset($this->data[$name]);
				}
			}

			$mon = new MyClass();

			//__setが呼び出される。
			$mon->Jan="睦月";
			$mon->Feb="如月";
			$mon->Mar="弥生";

			//__getが呼び出される。
			print "&lt;h1&gt;".$mon-&gt;Feb."&lt;/h1&gt;";
			print"&lt;br&gt;";

			//__issetが呼び出される
			if(isset($mon->Dec)){
				print"&lt;h2&gt;定義済み&lt;/h2&gt;";
			}else{
				print"&lt;h2&gt;未定義&lt;/h2&gt;";
			}
			</pre>';
	?>
</body>

</html>