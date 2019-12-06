<!--共有HTMLフレーム1の読み込み-->
<?php include('./bootstrap_frame1.php'); ?>
	<title>DB_連携_kensaku_delete</title>
<!--共有HTMLフレーム2の読み込み-->
<?php include('./bootstrap_frame2.php'); ?>
	<nobr><h1>商品削除</h1></nobr>  
<!--共有HTMLフレーム3の読み込み-->
<?php include('./bootstrap_frame3.php'); ?>

<?php
	//DBクラスの読み込み
	require_once('./DBaccess.php');
	//idをもらいDBから一意のレコードを抽出
	$id=$_GET['id'];
	$rec = DB::DB_select_id($id);
	//抽出したレコードをそれぞれ変数に代入
	$name=$rec['name'];
	$price=$rec['price'];
	$contents=$rec['contents'];
	$comment=$rec['comment'];
?>
<!--商品削除確認画面の作成-->
<table>
<tr>
<td>商品id</td>
<td><?php print $id; ?></td>
</tr>
<tr>
<td>商品名</td>
<td><?php print $name; ?></td>
</tr>
<tr>
<td>価格</td>
<td><?php print $price; ?>円</td>
</tr>
<tr>
<td>contents</td>
<td><?php print $contents; ?></td>
</tr>
<tr>
<td>comment</td>
<td><?php print '<img src="./gazou/'.$comment.'">'; ?></td>
</tr>
</table>
<br />
この商品を削除してよろしいですか？<br />
<form method="post" action="kensaku_delete_done.php">
<input type="hidden" name="id" value="<?php print $id; ?>">
<input type="hidden" name="comment" value="<?php print $comment; ?>">
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
</form>

<!--共有HTMLフレーム4の読み込み-->
<?php include('./bootstrap_frame4.php'); ?>

