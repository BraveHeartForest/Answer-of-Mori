<?php

//ファイルの保存先です。
$uploadfile = './session_broken/filereserve.txt';


//POSTリクエストによるページ遷移かをチェックします。

if($_SERVER['REQUEST_METHOD']==='POST'){


	//エラーコード2だった場合(HTMLファイルの制限超過)
	if($_FILES['upload']['error']===2){
		print'ファイルサイズを小さくしてください。';

	//サイズが0（ファイルが空）の場合
	}elseif($_FILES['upload']['size']===0){
		print'ファイルを選択してください。';
	
	//テキストファイルじゃなかった場合
	}elseif($_FILES['upload']['type'] !== 'text/plain'){
		print'テキストファイルを選択してください。';

	//アップロードが成功した場合
	}elseif($_FILES['upload']['error']===0){
		//アップロードされたファイルに、パスとファイル名を設定して保存します。
		move_uploaded_file($_FILES['upload']['tmp_name'],$uploadfile);

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
