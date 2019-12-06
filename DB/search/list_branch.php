<?php

if(isset($_POST['reload'])==true){	//変更ボタンが押された

	$id=$_POST['id_radio'];
	header('Location: reload.php?id='.$id);
	exit();
}

if(isset($_POST['delete'])==true){	//削除ボタンが押された

	$checked = $_POST['id_check'];
//	$count = count($checked);
	session_start();
	$_SESSION['checked'] = $checked;
	header('Location: delete.php');
	exit();
}
