﻿<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>CLASS2</title>
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




	class Cat
	{	//(1)

		public $age;	//(5)・(6)で最初は0歳



		function __construct()
		{	//(1)
			$this->name = "<p>猫</p>";
			$this->age = 0;
		} // end of __construction

		function show()
		{	//(1)用
			print $this->name;
		} //end of show

		public function mew()
		{	//(3)
			$cat_act_mew = "<p>なく</p>";
			echo $cat_act_mew;
		}	//end of mew

		public function eating()
		{	//(3)
			$cat_act_eat = "<p>エサを食べる</p>";
			echo $cat_act_eat;
		}	//end of eating

		public function purr()
		{	//(3)
			$cat_act_purr = "<p>ノドをならす</p>";
			echo $cat_act_purr;
		}	//end of purr

		public function BirthDay()
		{	//(6)
			$this->age = $age + 1;
			echo '<p>' . $age . '歳です。</p>';
		}	//end of Birthday

	} //end of Cat



	class DomesticCat extends Cat
	{	//(7)

		public function sleep()
		{
			$cat_act_sleep = "<p>眠っている。</p>";
			echo $cat_act_sleep;
		}
	}







	$myCat = new Cat();	//(1),(4)

	$myCat->show();	//(1)

	print '<p>' . gettype($myCat) . '</p>';	//(1)


	$int = 3;

	$myCat->mew();

	$myCat->eating();

	$myCat->purr();

	$myCat->BirthDay();
	$myCat->BirthDay();
	$myCat->BirthDay();


	$myCat = new DomesticCat();

	$myCat->sleep();

	?>
</body>

</html>