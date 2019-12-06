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
		//idをもらいDBから一意のレコードを抽出
		$id=$_GET['id'];
		$rec = DB::DB_select_id($id);
		//抽出したレコードをそれぞれ変数に代入
		$name=$rec['name'];
		$price=$rec['price'];
		$contents=$rec['contents'];
		$comment_old=$rec['comment'];
		$disp_comment='<img src="./gazou/'.$comment_old.'">';
	}
	//入力欄のエラーチェック kensaku_edit_checkから戻った証として$_GETを使う
	if(!empty($_GET['rireki'])) {
		if(empty($_SESSION['name'])) {
			print '商品名が入力されていません。<br />';
		}
		if(empty($_SESSION['price'])) {
			print '価格が入力されていません。<br />';
  		} else {
			if(preg_match('/\A[0-9]+\z/',$_SESSION['price'])==0) {
				print '価格を半角数字で入力してください。<br />';
			}
  	}
		if(empty($_SESSION['contents'])) {
			print 'contentsが入力されていません。<br />';
		}
		if(empty($_SESSION['comment_kalappo']['name'])) {
			print '画像が選択されていません。<br />';
		}
	}
?>
<br />
<!--商品修正欄
		kensaku_menu.phpから飛んできた場合とkensaku_edit_check.phpから戻ってきた場合とで表示を分ける-->
<table>
<tr>
<td>商品ID</td>
<!--$_GET['rireki']があるならセッションに保存した値を表示 そうじゃない場合はもらってきたid,その他,抽出したレコードを表示-->
<td><?php if( isset($_SESSION['id']) && !empty($_GET['rireki']) ) { echo $_SESSION['id']; } else { echo $id; }?>
</td>
</tr>
<form method="post" action="kensaku_edit_check.php" enctype="multipart/form-data">
<!--hiddenでidと古い画像をPOST送信,rirekiがありセッションで保存していた場合も送る-->
<input type="hidden" name="id" 
       value="<?php if( isset($_SESSION['id']) && !empty($_GET['rireki']) ) { echo $_SESSION['id'];} 
										else { echo $id; } ?>">
<input type="hidden" name="comment_old" 
       value="<?php if( isset($_SESSION['comment_old']) && !empty($_GET['rireki']) ) { echo $_SESSION['comment_old']; }
										else{ echo $comment_old; }?>">
<tr>
	<?php print '<td>商品名</td>'; ?>
<td>
	<input type="text" name="name" style="width:200px" 
				 value="<?php if( isset($_SESSION['name']) && !empty($_GET['rireki']) ){ echo $_SESSION['name']; }
					 						else{ print $name; }?>">
</td>
</tr>
<tr>
	<?php print '<td>価格</td>'; ?>
<td>
	<input type="text" name="price" style="width:50px" 
				 value="<?php if( isset($_SESSION['price']) && !empty($_GET['rireki']) ){ echo $_SESSION['price'];} 
					            else { print $price; }?>">円
</td>
</tr>
<tr>
	<?php print '<td>contents</td>'; ?>
<td>
	<textarea name="contents"><?php if( isset($_SESSION['contents']) && !empty($_GET['rireki']) ){ echo $_SESSION['contents'];}
									else{ print $contents; } ?></textarea>
</td>
</tr>
<tr>
<td>画像</td>
<td><?php if( isset($_SESSION['comment_kalappo']['name']) && !empty($_GET['rireki']) ){
						 echo '<img src="./gazou/'.$_SESSION['comment_kalappo']['name'].'">'; 
					} else if(isset($disp_comment)){print $disp_comment; }?></td>
</tr>
<tr>
    <?php print '<td>comment</td>'; ?>
<td>
    <input type="file" name="comment" style="width:300px">
</td>
</tr>
</table>
<br />

<!--inputにform属性を指定,id=form-formのformタグに飛ぶ-->
<input form="form-form" type="submit" value="戻る">
<input type="submit" value="ＯＫ">
<br />
</form>
<!--page_id=1を指定してkensaku_menuに飛ぶと検索一覧の1ページ目に飛ぶ-->
<form id="form-form"　method="get" action="kensaku_menu.php" >
<input type="hidden" name="page_id" value="1">
</form>
<!--共有HTMLフレーム4の読み込み-->
<?php include('./bootstrap_frame4.php'); ?>