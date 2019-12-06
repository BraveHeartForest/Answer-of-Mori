<?php
//Smatyライブラリ読み込み
require_once("C:\/xampp\php\smarty-2.6.28\Smarty.class.php");

//Smartyのインスタンスを作成
$smarty = new Smarty();

//各ディレクトリの指定
$smarty->template_dir = "../smarty/templates";
$smarty->compile_dir = "../smarty/templates_c";
$smarty->config_dir   = '../smarty/configs/';
$smarty->cache_dir    = '../smarty/cache/';

//キャッシュ機能の有効化
//$smarty->caching = true;

//テンプレートの変数に値に割り当てる
// $smarty->assign("title", "Smartyサンプル1");
// $smarty->assign("value1", "1つ目の値");
// $smarty->assign("value2", "2つ目の値");

//テンプレートに値を割り当てる（連想配列で一気に値を引き渡す場合）
$ref = array(
	     "title"=>"Smartyサンプル1",
	     "value1"=>"1つ目の値",
	     "value2"=>"2つ目の値"
	    );
$smarty->assign($ref);

//テンプレートを指定し表示
$smarty->display("template1.tpl");
