<?php
    session_start();
?>
<!--共有HTMLフレーム1の読み込み-->
<?php include('./bootstrap_frame1.php'); ?>
		<title>DB_連携_kensaku_edit</title>
<!--共有HTMLフレーム2の読み込み-->
<?php include('./bootstrap_frame2.php'); ?>
		<nobr><h1>商品更新</h1></nobr>  
<!--共有HTMLフレーム3の読み込み-->
<?php include('./bootstrap_frame3.php'); ?>

<?php
	//DBクラスの読み込み
	require_once('./DBaccess.php');

	//kensaku_edit_checkから戻った時にエラーが出ないようにif文で$_GET['id']があるかどうか判定
	if(!empty($_GET['id'])) {
		$id=$_GET['id'];

		$rec = DB::DB_select_id($id);

		$name=$rec['name'];
		$price=$rec['price'];
		$contents=$rec['contents'];
		$comment_old=$rec['comment'];
		$disp_comment='<img src="./gazou/'.$comment_old.'">';
	}
	if(empty($_SESSION['name']) && !empty($_SESSION['flg_name'])) {
		print '商品名が入力されていません。<br />';
	}
	if(empty($_SESSION['price']) && !empty($_SESSION['flg_price']) ) {
		print '価格が入力されていません。<br />';
  	} 
  if(!empty($_SESSION['price']) && !empty($_SESSION['flg_price']) ) {
		if(preg_match('/\A[0-9]+\z/',$_SESSION['price'])==0) {
			print '価格を半角数字で入力してください。<br />';
		}
  }
	if(empty($_SESSION['contents']) && !empty($_SESSION['flg_contents'])) {
		print 'contentsが入力されていません。<br />';
	}
	if(empty($_SESSION['comment_kalappo']['name']) && !empty($_SESSION['flg_comment'])) {
		print '画像が選択されていません。<br />';
	}
?>
<br />
<table border=1>
<tr>
<td>商品ID</td>
<td><?php if( isset($_SESSION['id']) ) { echo $_SESSION['id']; } else { print $id; }?>
</td>
</tr>

<form method="post" action="kensaku_edit_check.php" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php if(isset($_SESSION['id'])) { echo $_SESSION['id'];} else {print $id;} ?>">
<input type="hidden" name="comment_old" value="<?php print $comment_old; ?>">

<tr>
	<?php  if(empty($_SESSION['name'])){
            print '<td>商品名を入力してください。</td>';
          } else {
            print '<td>商品名</td>';
          } 
    ?>
<td><input type="text" name="name" style="width:200px" 
	value="<?php if( isset($_SESSION['name']) ){ echo $_SESSION['name'];}else{ print $name; }?>">
</td>
</tr>
<tr>
	<?php  if(empty($_SESSION['price'])){
            print '<td>価格を入力してください。</td>';
		   } else {
            print '<td>価格</td>';
           } 
    ?>
<td><input type="text" name="price" style="width:50px" 
	value="<?php if( isset($_SESSION['price']) ){ echo $_SESSION['price'];} else{ print $price; }?>">円
</td>
</tr>
<tr>
	<?php  if(empty($_SESSION['contents'])){
            print '<td>contentsを入力してください。</td>';
          } else {
            print '<td>contents</td>';
          } 
    ?>
<td>
	<textarea name="contents"><?php if( isset($_SESSION['contents']) ){ echo $_SESSION['contents'];}else{ print $contents; } ?></textarea>
</td>
</tr>
<tr>
<td>画像</td>
<td><?php if(isset($_SESSION['comment_kalappo']['name'])) { echo '<img src="./gazou/'.$_SESSION['comment_kalappo']['name'].'">'; } 
					else if(isset($disp_comment)){print $disp_comment; }?></td>
</tr>
<tr>
    <?php if(empty($_SESSION['comment_kalappo']['name'])) {
            print '<td>画像を選んでください。<br />';
          } else {
            print '<td>comment</td>';
          } 
    ?>
<td>
    <input type="file" name="comment" style="width:300px"
    value="<?php if( !empty($_SESSION['comment_kalappo']['name']) ){ echo $_SESSION['comment_kalappo']['name'];}?>">
</td>
</tr>
</table>
<br />
<input type="button" onclick="history.back()" value="戻る">
<input type="submit" value="ＯＫ">
<br />
</form>

<!--共有HTMLフレーム4の読み込み-->
<?php include('./bootstrap_frame4.php'); ?>