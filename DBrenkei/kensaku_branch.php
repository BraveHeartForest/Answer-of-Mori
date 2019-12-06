<?php
	//更新が押された場合,商品idを受け取りkensaku_edit.phpにGET送信
    if(isset($_POST['edit'])==true) {
		$id=$_POST['id_sentaku'];
		header('Location:kensaku_edit.php?id='.$id);
        exit();
    }
	//削除が押された場合,商品idを受け取りkensaku_delete.phpにGET送信
    if(isset($_POST['delete'])==true) {
	    $id=$_POST['id_sentaku'];
	    header('Location:kensaku_delete.php?id='.$id);
	    exit();
    }
?>
