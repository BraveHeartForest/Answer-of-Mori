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

//配列の作成
$data = array("a","b","c","d");

//テンプレートの変数に値に割り当てる
$smarty->assign("title", "Smartyサンプル2");
$smarty->assign("data", @$data);
/*
@$dataにしないと以下のエラー文が表示される。

( ! ) Notice: Undefined variable: data in C:\xampp\htdocs\mori_folder\Answer-of-mori\use_smarty\public\smarty2.php on line 23
Call Stack
#	Time	Memory	Function	Location
1	0.2023	127736	{main}( )	..\smarty2.php:0
*/


//テンプレートを指定し表示
$smarty->display("template2.tpl");
