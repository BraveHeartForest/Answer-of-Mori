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

//連想配列の作成
$data = [
    "Sun"=>"日曜日",
    "Mon"=>"月曜日",
    "Tue"=>"火曜日",
    "Wed"=>"水曜日",
    "Thu"=>"木曜日",
    "Fri"=>"金曜日",
];

//テンプレートの変数に値に割り当てる
$smarty->assign("title", "Smartyサンプル3");
$smarty->assign("data", @$data);

//テンプレートを指定し表示
$smarty->display("template3.tpl");
