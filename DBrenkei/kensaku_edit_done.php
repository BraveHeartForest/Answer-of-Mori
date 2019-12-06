<?php
//DBクラスの読み込み
require_once('./DBaccess.php');
//サニタイジング用関数の読み込み
require_once('./common.php');
//$_POSTをサニタイジングし、$postに代入
$post=sanitize($_POST);
//$_POSTで受け取りサニタイジングしたデータをそれぞれ変数に代入
$id=$post['id'];
$name=$post['name'];
$price=$post['price'];
$contents=$post['contents'];
$comment_old=$post['comment_old'];
$comment=$post['comment'];
//DBクラスからDB_edit_doneメソッドを使用し、$kensaku_edit_doneに代入
$kensaku_edit_done = DB::DB_edit_done($name,$price,$contents,$comment,$id);
//古い画像と新しい画像が違う場合のみフォルダから古い画像を削除
if(!empty($comment_old)){
    if($comment_old != $comment)
    {
	    unlink('./gazou/'.$comment_old);
    }
}
//return=1ならリダイレクトそうじゃない場合エラーメッセージを表示
if($kensaku_edit_done == 1){
    echo '<script type="text/javascript">
        setTimeout("redirect()", 0);
        function redirect() {
            location.href="./top.php";
        }
      </script>';
    exit();
} else {
    print $kensaku_edit_done;
}

?>