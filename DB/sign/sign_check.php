<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>DB</title>
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
	try {




		require_once("../funCLASS/function.php");

		$post = sanitize($_POST);

		$success = 0;

		if ($post['pro_name'] == null || $post['pro_name'] == '') {
			print '<p class="text-danger bg-warning">商品名の入力は必須です。</p>';
			$success = 1;
		} else {
			print '<p>商品名は【' . $post['pro_name'] . '】と入力されました。</p>';
		}

		if ($post['price'] == null || $post['price'] == '') {
			print '<p class="text-danger bg-warning">値段の入力は必須です。</p>';
			$success = 1;
		} else {
			if (noCheck($post['price']) == 1) {
				print '<p>半角数字で入力してください。</p>';
				$success = 1;
			} else {
				print '<p>値段は【' . $post['price'] . '】と入力されました。</p>';
			}
		}

		if ($post['contents'] == null || $post['contents'] == '') {
			print '<p class="text-danger bg-warning">コンテンツ内容は空欄です。</p>';
		} else {
			print '<p>コンテンツは【' . $post['contents'] . '】と入力されました。</p>';
		}

		if ($post['comment'] == null || $post['comment'] == '') {
			print '<p class="text-danger bg-warning">コメント内容は空欄です。</p>';
		} else {
			print '<p>コメントは【' . $post['comment'] . '】と入力されました。</p>';
		}

		$pro_name = $post['pro_name'];
		$price = $post['price'];
		$contents = $post['contents'];
		$comment = $post['comment'];






		if ($success == 0) {
			?>
			<form method="post" action="./sign_done.php">
				<input type="hidden" name="pro_name" value="<?= $pro_name ?>">
				<input type="hidden" name="price" value="<?= $price ?>">
				<input type="hidden" name="contents" value="<?= $contents ?>">
				<input type="hidden" name="comment" value="<?= $comment ?>">
				<?php
				print '<p class="text-success">以上の内容でお間違いなければ送信ボタンを押してください。</p>';
				print '<input type="submit" value="確定"><br>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			} else {
				print '<form>';
				print '<p class="text-warning">記入漏れがありますので修正してください。</p>';
				print '<input type="button" onclick="history.back()" value="戻る">';
				print '</form>';
			}

			print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';

			/*
inputタグの内部へPHPを埋め込む方法は95~99行目を参考にしてください。
http://web-engine.hatenadiary.com/entry/2016/05/13/134134
*/
		} catch (Exception $e) {
			print '何らかの障害が発生して表示できません。<br>\n' . $e->getMessage() . '<br>\n';
			print '<a href="../index.php"><button class="btn btn-primary">トップ画面に戻る。</button></a>';
		}
		?>
</body>

</html>