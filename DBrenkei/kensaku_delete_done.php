<?php
//DBクラスの読み込み
require_once('./DBaccess.php');
//サニタイジング用関数の読み込み
require_once('./common.php');
//$_POSTをサニタイジングし、$postに代入
$post=sanitize($_POST);
//$_POSTで受け取りサニタイジングしたデータをそれぞれ変数に代入
$id=$post['id'];
$comment=$post['comment'];
//DBクラスからDB_deleteメソッドを使用し、$kensaku_delete_doneに代入
$kensaku_delete_done = DB::DB_delete($id);

//画像をフォルダから削除
if(!empty($comment))
{
	unlink('./gazou/'.$comment);
}

//return=1ならリダイレクトそうじゃない場合エラーメッセージを表示
if($kensaku_delete_done == 1){
    echo '<script type="text/javascript">
        setTimeout("redirect()", 0);
        function redirect() {
            location.href="./top.php";
        }
      </script>';
    exit();
} else {
    print $kensaku_delete_done;
}
?>