<?php
session_start();
?>
<!--共有HTMLフレーム1の読み込み-->
<?php include('./bootstrap_frame1.php'); ?>
	<title>DB_連携_kensaku_edit_check</title>
<!--共有HTMLフレーム2の読み込み-->
<?php include('./bootstrap_frame2.php'); ?>
	<nobr><h1>商品更新確認</h1></nobr>  
<!--共有HTMLフレーム3の読み込み-->
<?php include('./bootstrap_frame3.php'); ?>

<?php
//サニタイジング用関数の読み込み
require_once('./common.php');
//$_POSTをサニタイジングし、$postに代入
$post=sanitize($_POST);
//$_POSTで受け取りサニタイジングしたデータをそれぞれ変数に代入
$id=$post['id'];
$name=$post['name'];
$price=$post['price'];
$contents=$post['contents'];
$comment=$_FILES['comment'];
$comment_old=$post['comment_old'];
//$_SESSIONに受け取ったデータを保存
$_SESSION['comment_old'] = $comment_old;
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
$_SESSION['price'] = $price;
$_SESSION['contents'] = $contents;

//$_FILEで受け取っているので配列の空要素を削除しセッション変数に代入,入力欄のエラーチェックに使う
$_SESSION['comment_kalappo'] = array_filter($comment);

//入力欄のエラーチェック エラーがあればkensaku_edit.phpにリダイレクトしGETで戻った証(rireki)を送る
if($name=='') {
	echo '<script type="text/javascript">
              setTimeout("redirect()", 0);
              function redirect() {
              location.href="./kensaku_edit.php?rireki=1";
              }
              </script>';
	exit();
} 
if(preg_match('/\A[0-9]+\z/',$price)==0) {
	echo '<script type="text/javascript">
              setTimeout("redirect()", 0);
              function redirect() {
              location.href="./kensaku_edit.php?rireki=1";
              }
              </script>';
	exit();
} 
if($contents=='') {
	echo '<script type="text/javascript">
              setTimeout("redirect()", 0);
              function redirect() {
              location.href="./kensaku_edit.php?rireki=1";
              }
              </script>';
	exit();
}
if(empty($_SESSION['comment_kalappo']['name'])) {
	echo '<script type="text/javascript">
		   setTimeout("redirect()", 0);
		   function redirect() {
		   location.href="./kensaku_edit.php?rireki=1";
			}
		   </script>';
	exit();
}	
if($comment['size']>0) {
	if($comment['size']>1000000) {
		echo '<script type="text/javascript">
			   setTimeout("redirect()", 0);
			   function redirect() {
			   location.href="./kensaku_edit.php?rireki=1";
			   }
			   </script>';
	exit();
	}
}
//商品更新確認画面の作成
print '<table>
	   <tr>
	   <td>ID名</td>
	   <td>'.$id.'</td>
	   </tr>
	   <tr>
	   <td>商品名</td>
	   <td>'.$name.'</td>
	   </tr>
	   <tr>
	   <td>価格</td>
	   <td>'.$price.'円</td>
	   </tr>
	   <tr>
	   <td>contents</td>
	   <td>'.$contents.'</td>
	   </tr>
	   <tr>
	   <td>comment</td>';
move_uploaded_file($comment['tmp_name'],'./gazou/'.$comment['name']);
print '<td><img src="./gazou/'.$comment['name'].'"></td>
	   </tr>
	   </table>
	   <br />上記のように変更します。<br />
	   <form method="get" action="kensaku_edit.php" style="display:inline">
	   <input type="hidden" name="rireki" value="1">
	   <input type="submit" value="戻る">
	   </form>
	   <form method="post" action="kensaku_edit_done.php" style="display:inline">
	   <input type="hidden" name="id" value="'.$id.'">
	   <input type="hidden" name="name" value="'.$name.'">
	   <input type="hidden" name="price" value="'.$price.'">
	   <input type="hidden" name="contents" value="'.$contents.'">
	   <input type="hidden" name="comment" value="'.$comment['name'].'">
	   <input type="hidden" name="comment_old" value="'.$comment_old.'">
	   <input type="submit" value="ＯＫ">
	   </form>';
?>

<!--共有HTMLフレーム4の読み込み-->
<?php include('./bootstrap_frame4.php'); ?>
