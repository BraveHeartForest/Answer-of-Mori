<?php
session_start();
?>
<!--共有HTMLフレーム1の読み込み-->
<?php include('./bootstrap_frame1.php'); ?>
    <title>DB_連携_kensaku</title>
<!--共有HTMLフレーム2の読み込み-->
<?php include('./bootstrap_frame2.php'); ?>
    <nobr><h1>検索メニュー</h1></nobr>
<!--共有HTMLフレーム3の読み込み-->
<?php include('./bootstrap_frame3.php'); ?>


<?php 
//サニタイジング用関数の読み込み
require_once('./common.php');
//DBクラスの読み込み
require_once('./DBaccess.php');
//$_POSTをサニタイジングし、$postに代入
$post=sanitize($_POST);
//$_POSTで受け取りサニタイジングしたデータをそれぞれ変数に代入
$name_search=$post['name_search'];
$price_search1=$post['price_search1'];
$price_search2=$post['price_search2'];
$kensaku_flg=$post['kensaku_flg'];

//検索エラーチェック
//下限価格または上限のどちらか一方しか入力されてない場合、全入力するように促す
if(empty($name_search) && !empty($price_search1) && empty($price_search2)) {
    if(preg_match('/\A[0-9]+\z/',$price_search1)) {
        print '商品名が入力されていません。<br />';
        print '上限価格を半角数字で入力してください。<br />';
    } else {
        print '商品名が入力されていません。<br />';
        print '下限価格を半角数字で入力してください。<br />';
        print '上限価格を半角数字で入力してください。<br />';
    }
}
if(empty($name_search) && empty($price_search1) && !empty($price_search2)) {
    if(preg_match('/\A[0-9]+\z/',$price_search2)) {
        print '商品名が入力されていません。<br />';
        print '下限価格を半角数字で入力してください。<br />';
    } else {
        print '商品名が入力されていません。<br />';
        print '下限価格を半角数字で入力してください。<br />';
        print '上限価格を半角数字で入力してください。<br />';
    }
}
//下限価格、上限価格が入力の場合は価格のみで検索できるので間違いを直すように促す
if(empty($name_search) && !empty($price_search1) && !empty($price_search2)) {
    if(preg_match('/\A[0-9]+\z/',$price_search1)==0 && preg_match('/\A[0-9]+\z/',$price_search2)) {
        print '下限価格を半角数字で入力してください。<br />';
    }
    if(preg_match('/\A[0-9]+\z/',$price_search1) && preg_match('/\A[0-9]+\z/',$price_search2)==0) {
        print '上限価格を半角数字で入力してください。<br />';
    }
    if (preg_match('/\A[0-9]+\z/',$price_search1)==0 && preg_match('/\A[0-9]+\z/',$price_search2)==0) {
        print '下限価格を半角数字で入力してください。<br />';
        print '上限価格を半角数字で入力してください。<br />';
    }
}
//商品名がある場合は下限か上限が間違ってるかどうかをチェックして全入力を促す
if(!empty($name_search) && !empty($price_search1) && empty($price_search2)) {
    if(preg_match('/\A[0-9]+\z/',$price_search1)==0) {
        print '下限価格を半角数字で入力してください。<br />';
        print '上限価格を半角数字で入力してください。<br />';
    } else {
        print '上限価格を半角数字で入力してください。<br />';
    }
}
if(!empty($name_search) && empty($price_search1) && !empty($price_search2)) {
    if(preg_match('/\A[0-9]+\z/',$price_search2)==0) {
        print '下限価格を半角数字で入力してください。<br />';
        print '上限価格を半角数字で入力してください。<br />';
    } else {
        print '下限価格を半角数字で入力してください。<br />';
    }
}
if(!empty($name_search) && !empty($price_search1) && !empty($price_search2)) {
    if(preg_match('/\A[0-9]+\z/',$price_search1)==0) {
        print '下限価格を半角数字で入力してください。<br />';
    }
    if(preg_match('/\A[0-9]+\z/',$price_search2)==0) {
        print '上限価格を半角数字で入力してください。<br />';
    }
}
?>

<!--検索入力欄 検索履歴とページング用の履歴を表示する-->
<form action="kensaku_menu.php" method="post">
<input type="hidden" name="kensaku_flg" value="1">
<table>
<tr>
<td>商品名</td>
<td>
    <input type="text" name="name_search" 
    value="<?php if( isset($name_search) ) { echo $name_search; }
                 else if( isset($_SESSION['name_search_old']) && isset($_GET['page_id'])) { echo $_SESSION['name_search_old']; }?>">
</td>
</tr>
<tr>
<td>価格</td>
<td>
    <input type="text" name="price_search1" 
    value="<?php if( isset($price_search1) ) { echo $price_search1; }
                 else if( isset($_SESSION['price_search1_old']) && isset($_GET['page_id'])) { echo $_SESSION['price_search1_old']; } ?>">円~
    <input type="text" name="price_search2"
    value="<?php if( isset($price_search2) ) { echo $price_search2; } 
                 else if( isset($_SESSION['price_search2_old']) && isset($_GET['page_id'])) { echo $_SESSION['price_search2_old']; }   ?>">円
</td>
</tr>
</table>
<input type="submit" value="検索">
</form>
<br />

<?php
//検索ボタンが押された場合、またはページングした場合に検索結果一覧を出す
if($kensaku_flg == 1 || isset($_GET['page_id'])){

    //検索が押された場合DBからレコードをとって$recに保存
    if($kensaku_flg ==1) {
        //ページング用に検索ボタンが押されたら入力をoldに保持しておく
        $_SESSION['name_search_old'] = $name_search;
        $_SESSION['price_search1_old'] = $price_search1;
        $_SESSION['price_search2_old'] = $price_search2;
        //価格のみ検索
        if($name_search=='' &&  preg_match('/\A[0-9]+\z/',$price_search1) && preg_match('/\A[0-9]+\z/',$price_search2) ) {
            $rec = DB::DB_PRICE_BETWEEN($price_search1,$price_search2);
        }
        //何も入力されていない場合全件検索
        if($name_search=='' && $price_search1=='' && $price_search2=='') {
            $rec = DB::DB_SELECT_ALL();
        } 
        //名前のみ検索
        if($name_search && $price_search1=='' && $price_search2=='') {
            $rec = DB::DB_SELECT_NAME_LIKE($name_search);
        }
        //全入力検索
        if($name_search && preg_match('/\A[0-9]+\z/',$price_search1) && preg_match('/\A[0-9]+\z/',$price_search2)) {
            $rec = DB::DB_SELECT_NAME_LIKE_AND_PRICE_BETWEEN($name_search,$price_search1,$price_search2);
        }
        //ページング用にDBからとってきたレコードを保存
        if(!empty($rec)){
            $_SESSION['rec_old'] = $rec;
        }
    }

    //ページングした場合$_SESSION['rec_old']から値を取り出して$recに代入
    if(isset($_GET['page_id'])){
        $rec = $_SESSION['rec_old'];
    }

    //$kekkaに0を代入し、検索結果があるかどうかの判定に使う
    $kekka = 0;
    //検索結果一覧画面
    if(!empty($rec))  {
        print '<table class="table table-bordered table-striped">';
        print '<tr>';
        print '<th>id</th>';
        print '<th>商品名</th>';
        print '<th>価格</th>';
        print '<th>contents</th>';
        print '<th>comment</th>';
        print '<th>更新</th>';
        print '<th>削除</th>';
        print '</tr>';

        //ページング
        define('MAX','5'); //1ページのレコード件数
        $rec_num = count($rec); //トータルデータ件数
        $max_page = ceil($rec_num / MAX); //トータルページ数※ceilは小数点を切り捨てる関数
        if(!isset($_GET['page_id'])){ //$_GET['page_id'] はURLに渡された現在のページ数
         $now = 1; //設定されてない場合は1ページ目にする
        }else{
            $now = $_GET['page_id'];
        }
        $start_no = ($now - 1) * MAX; //配列の何番目から取得すればよいか
        //array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
        $disp_data = array_slice($rec, $start_no, MAX, true);

        //モーダルのid設定用に$pを宣言
        $p = 0;
        //レコードからforeachで値を取り出す
        foreach($disp_data as $value) {
            if($disp_data==false) {
                break;
            }
            $kekka=1;  
            //更新か削除が押された場合kensaku_branch.phpに飛ぶ
            print '<form method="post" action="kensaku_branch.php">';
	        print '<tr>';
            print '<td><input type="hidden" name="id_sentaku" value="'.$value['id'].'">'.$value['id'].'</td>';
            print '<td><nobr>'.$value['name'].'</nobr></td>';
            print '<td>'.$value['price'].'円</td>';
            print '<td><textarea>'.$value['contents'].'</textarea></td>';
            
            //モーダルを開くリンク
            print '
            <td>
                <a class="btn btn-light" data-toggle="modal" data-target="#yasai'.$p.'" data-backdrop="static">
                    <img width="50px" hight="40px" src="./gazou/'.$value['comment'].'">
                </a>
            </td>';
            //リンククリック後に表示される画面の内容
            print '
            <div class="modal fade" id="yasai'.$p.'" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title" id="title"><h4 class="text-center">'.$value['name'].'</h4></div>
                        </div>
                        <div class="modal-body">
                            <label><img src="./gazou/'.$value['comment'].'"></label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>';
            $p++;    

            print '<td><input type="submit" name="edit" value="更新"></td>';
            print '<td><input type="submit" name="delete" value="削除"></td>';
            print '</tr>';
            print '</form>';
            
        }
        print '</table>';

        echo '全件数'. $rec_num. '件'. '　'; // 全データ数の表示です。
 
        if($now > 1){ // リンクをつけるかの判定
            echo '<a href=\'./kensaku_menu.php?page_id='.($now - 1).'\')>前へ</a>'. '　';
        } else {
            echo '前へ'. '　';
        }
 
        for($i = 1; $i <= $max_page; $i++){ //最大ページ数分リンクを作成
            if ($i == $now) { //現在表示中のページ数の場合はリンクを貼らない
                echo $now. '　'; 
            } else {
                echo '<a href=\'./kensaku_menu.php?page_id='. $i. '\')>'. $i. '</a>'. '　';
            }
        }
 
        if($now < $max_page){ // リンクをつけるかの判定
            echo '<a href=\'./kensaku_menu.php?page_id='.($now + 1).'\')>次へ</a>'. '　';
        } else {
            echo '次へ';
        }
    }
    if($kekka==0) {
        print '検索結果がありません。<br /><br />';
    }
}
?>
<!--共有HTMLフレーム4の読み込み-->
<?php include('./bootstrap_frame4.php'); ?>


