<?php
//DBクラスの読み込み
require_once('./DBaccess.php');
//サニタイジング用関数の読み込み
require_once('./common.php');
//$_POSTをサニタイジングし、$postに代入
$post=sanitize($_POST);
//$_POSTで受け取りサニタイジングしたデータをそれぞれ変数に代入
$name=$post['name'];
$price=$post['price'];
$contents=$post['contents'];
$comment=$post['comment'];
//DBクラスからDB_tourokuメソッドを使用し、$tourokuに代入
$touroku = DB::DB_touroku($name,$price,$contents,$comment);
//return=1ならリダイレクトそうじゃない場合エラーメッセージを表示
if($touroku == 1){
    echo '<script type="text/javascript">
        setTimeout("redirect()", 0);
        function redirect() {
            location.href="./top.php";
        }
      </script>';
    exit();
} else {
    print $touroku;
}

?>