<?php
  session_start();
?>
<!--共有HTMLフレーム1の読み込み-->
<?php include('./bootstrap_frame1.php'); ?>
  <title>DB_連携_kensaku_touroku</title>
<!--共有HTMLフレーム2の読み込み-->
<?php include('./bootstrap_frame2.php'); ?>
  <nobr><h1>商品登録</h1></nobr>
<!--共有HTMLフレーム3の読み込み-->  
<?php include('./bootstrap_frame3.php'); ?>

<!--入力欄のエラーチェック
    touroku_checkから戻った証として$_GETを使う-->
<?php 
  if(!empty($_GET['rireki'])) {
    if(empty($_SESSION['name'])) {
      print '商品名が入力されていません。<br />';
    } 
    if(empty($_SESSION['price'])) {
      print '価格が入力されていません。<br />';
    } 
    if(!empty($_SESSION['price'])) {
      if(preg_match('/\A[0-9]+\z/',$_SESSION['price'])==0) {
          print '価格を半角数字で入力してください。<br />';
      }
    }
    if(empty($_SESSION['contents'])) {
      print 'contentsが入力されていません。<br />';
    } 
    if(empty($_SESSION['comment_kalappo']['name'])) {
      print '画像が選択されていません。<br /><br />';
    } 
    if(!empty($_SESSION['comment_kalappo']['name'])) {
      print '画像をもう一度選択してください。<br /><br />';
    } 
  }
?>

<!--商品入力欄の作成-->
<form method="post" action="touroku_check.php" enctype="multipart/form-data">
<table border=1>
<tr>
  <?php print '<td>商品名</td>'; ?>
<td>
  <input type="text" name="name" style="width:200px" 
  value="<?php if(!empty($_SESSION['name']) && !empty($_GET['rireki'])){ echo $_SESSION['name']; }?>">
</td>
</tr>
<tr>
  <?php print '<td>価格</td>'; ?>
<td>
  <input type="text" name="price" style="width:50px" 
  value="<?php if(!empty($_SESSION['price']) && !empty($_GET['rireki'])){ echo $_SESSION['price'];}?>">
</td>
</tr>
<tr>
  <?php print '<td>contents</td>'; ?>
<td>
  <textarea name="contents"><?php if( !empty($_SESSION['contents']) && !empty($_GET['rireki'])){ echo $_SESSION['contents'];}?></textarea>
</td>
</tr>
<tr>
  <?php print '<td>comment</td>'; ?>
<td>
  <input type="file" name="comment" style="width:300px">
</td>
</tr>
</table>
<br />
<input type="submit" value="ＯＫ">
</form>
<!--共有HTMLフレーム4の読み込み-->
<?php include('./bootstrap_frame4.php'); ?>