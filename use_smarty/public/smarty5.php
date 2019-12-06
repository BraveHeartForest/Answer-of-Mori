<?php
//Smatyライブラリ読み込み
define('SMARTY_DIR', 'C:\/xampp\php\smarty-2.6.28\/');
require_once(SMARTY_DIR . 'Smarty.class.php');

//Smartyのインスタンスを作成
$smarty = new Smarty();

//各ディレクトリの指定
$smarty->template_dir = "../smarty/templates";
$smarty->compile_dir = "../smarty/templates_c";
$smarty->config_dir   = '../smarty/configs/';
$smarty->cache_dir    = '../smarty/cache/';

//キャッシュ機能の有効化
//$smarty->caching = true;

//連想配列の配列化
$data = array(
    array("name"=>"MySQL","price"=>"850円","qty"=>"5"),
    array("name"=>"BIND9","price"=>"780円","qty"=>"4"),
    array("name"=>"Apache","price"=>"480円","qty"=>"7")
    );

    // $data=[];

//テンプレートの変数に値に割り当てる
$smarty->assign("title", "Smartyサンプル5");
$smarty->assign("data", $data);

//テンプレートを指定し表示
$smarty->display("template5.tpl");