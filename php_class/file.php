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

	print '<h1 class="bg-primary">ファイル課題</h1>';


	print '<h2 class="bg-success">(1)ファイルが存在するか確認する(file_existsを使う)</h2>';

	if (file_exists('cookie1.php')) {
		print '<p>cookie1.phpというファイルは存在します。</p>';
	} else {
		print '<p>cookie1.phpというファイルは存在しません。</p>';
	}

	if (file_exists('cookie100.php')) {
		print '<p>cookie100.phpというファイルは存在します。</p>';
	} else {
		print '<p>cookie100.phpというファイルは存在しません。</p>';
	}
	print '<p>ファイルが存在するならばTRUEを返し、存在しないならばFALSEを返す。</p>';

	print "<pre>
if(file_exists('cookie1.php')){
	print'&lt;p&gt;cookie1.phpというファイルは存在します。&lt;/p&gt;';
	}else{
	print'&lt;p&gt;cookie1.phpというファイルは存在しません。&lt;/p&gt;';
}

if(file_exists('cookie100.php')){
	print'&lt;p&gt;cookie100.phpというファイルは存在します。&lt;/p&gt;';
	}else{
	print'&lt;p&gt;cookie100.phpというファイルは存在しません。&lt;/p>';
}</pre>";

	print '<h2 class="bg-success">(2)ファイル名の変更。</h2>';

	$file_name = '';	//ここにファイル名を代入しておく（実用時）

	$file_name = 'test.txt';

	if (file_exists($file_name)) {
		print '<p class="text-success">ファイルが存在するのでtest2.txtにファイル名を変更します。</p>';
		rename($file_name, 'test2.txt');
	} else {
		print '<p class="text-danger">ファイルが存在しないのでファイル名の変更が出来ません。</p>';
	}

	print 'rename(移動することファイル名,移動するパス)の形式でファイルを移動することが出来ます。';

	if (file_exists("test2.txt")) {
		print '<p class="text-success">ファイルが存在するのでtest2.txtにファイル名を変更します。</p>';
		rename("test2.txt", "./session_broken/test.txt");
	} else {
		print '<p class="text-danger">ファイルが存在しないのでファイルの移動が出来ません。</p>';
	}

	print "<pre>
\$file_name = '';	//ここにファイル名を代入しておく（実用時）

\$file_name ='test.txt';

if(file_exists(\$file_name)){
	print'&lt;p class=&quot;text-success&quot;&gt;ファイルが存在するのでtest2.txtにファイル名を変更します。&lt;/p&gt;';
	rename(\$file_name,'test2.txt');
	}else{
	print'&lt;p class=&quot;text-danger&quot;&gt;ファイルが存在しないのでファイル名の変更が出来ません。&lt;/p&gt;';
}

print'rename(移動することファイル名,移動するパス)の形式でファイルを移動することが出来ます。';

if(file_exists(&quot;test2.txt&quot;)){
	print'&lt;p class=&quot;text-success&quot;&gt;ファイルが存在するのでtest2.txtにファイル名を変更します。&lt;/p&gt;';
	rename(&quot;test2.txt&quot;,&quot;./session_broken/test.txt&quot;);
	}else{
	print'&lt;p class=&quot;text-danger&quot;&gt;ファイルが存在しないのでファイルの移動が出来ません。&lt;/p&gt;';
}
</pre>";


	print '<h2 class="bg-success">(3)アップロードされたファイルの存在をチェックする。</h2>';

	//formのenctypeにmultipart/form-dataを設定する。
	print '<form action="upload.php" method="post" enctype="multipart/form-data">';
	//MAX_FILE_SIZEでファイルサイズを制限します。
	print '<input type="hidden" name="MAX_FILE_SIZE" value="1000">';
	//input typeはfileを設定します。
	print '<input type="file" name="upload">';

	print '<input type="submit" value="アップロード">';
	print '</form>';

	print '<p class="bg-info">フォームタグの部分のコードです。</p>';
	print "<pre>
//formのenctypeにmultipart/form-dataを設定する。
print'&lt;form action=&quot;upload.php&quot; method=&quot;post&quot; enctype=&quot;multipart/form-data&quot;&gt;';
//MAX_FILE_SIZEでファイルサイズを制限します。
print'&lt;input type=&quot;hidden&quot; name=&quot;MAX_FILE_SIZE&quot; value=&quot;1000&quot;&gt;';
//input typeはfileを設定します。
print'&lt;input type=&quot;file&quot; name=&quot;upload&quot;&gt;';

print'&lt;input type=&quot;submit&quot; value=&quot;アップロード&quot;&gt;';
print'&lt;/form&gt;';
</pre>";


	print '<p class="bg-danger">以下はupload.phpの内容です。</p>';
	print "<pre>
&lt;?php

//ファイルの保存先です。
\$uploadfile = './session_broken/filereserve.txt';


//POSTリクエストによるページ遷移かをチェックします。

if(\$_SERVER['REQUEST_METHOD']==='POST'){


	//エラーコード2だった場合(HTMLファイルの制限超過)
	if(\$_FILES['upload']['error']===2){
		print'ファイルサイズを小さくしてください。';

	//サイズが0（ファイルが空）の場合
	}elseif(\$_FILES['upload']['size']===0){
		print'ファイルを選択してください。';
	
	//テキストファイルじゃなかった場合
	}elseif(\$_FILES['upload']['type'] !== 'text/plain'){
		print'テキストファイルを選択してください。';

	//アップロードが成功した場合
	}elseif(\$_FILES['upload']['error']===0){
		//アップロードされたファイルに、パスとファイル名を設定して保存します。
		move_uploaded_file(\$_FILES['upload']['tmp_name'],\$uploadfile);

		//完了メッセージを表示します。

		print 'アップロード完了です。';

//上記以外の場合
	}else{
		print'アップロードに失敗しました。';
	}

//POSTリクエストによる遷移じゃない場合
}else{
	print'不正なアクセスです。';
}
?&gt;
</pre>";



	print "}elseif(\$_FILES['upload']['size']===0){の部分がファイルの存在をチェックする部分です。";
	?>
</body>

</html>