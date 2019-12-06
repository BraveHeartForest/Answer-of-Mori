<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="ここに説明文を書く？">
	<meta name="author" content="ここにサイト制作者の名前を書く？">
	<title>Ajax,PHP,MySQLの連携練習</title>
	<!--CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!--自作CSS-->
	<style type="text/css">
		p {
			font-size: 20px;
		}

		label {
			font-size: 20px;
		}


		h1 {}

		h2 {}

		h3 {}
	</style>
</head>

<body>
	<label for="id_number">IDを入力：</label><input id="id_number" type="number"><br>
	<div id="result">
		<p>数値を入力してボタンを押してください。</p>
	</div>
	<button id="ajax">ボタン</button>
	
	<script>
	$(function(){
		$('#ajax').on('click',function(){
			$.ajax({
				url:'./dbconnect.php',	//送信先
				type:'POST',	//送信方法
				datatype:'json',	//受け取りデータの種類。
				data:{
					'id':$('#id_number').val()	//idにid_numberの値を入力？
				}
			})
			//通信成功時
			.done(function(data){
				$("#result").html("<p>ID番号"+data[0].id+"は「"+data[0].name+"」さんです。<br>内容は「"+data[0].contents+"」で、コメントは「"+data[0].comment+"」です。</p>");
				//id="result"の内容を書き換える。
				console.log('通信成功');
				console.log(data);
			})
			//通信失敗時
			.fail(function(data){
				$('#result').html(data);
				console.log('通信失敗');
				console.log(data);
			})
		});	//#ajax click end
	});	//END
	</script>
</body>

</html>