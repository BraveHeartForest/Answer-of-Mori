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
    array("name"=>"半熟卵のMySQL風チキンドリア","price"=>"850円","qty"=>"5"),
    array("name"=>"地鶏とキノコのBIND9風フェットチーネ","price"=>"780円","qty"=>"4"),
    array("name"=>"有機野菜のApache風グリーンサラダ","price"=>"480円","qty"=>"7")
    );

//テンプレートの変数に値に割り当てる
$smarty->assign("title", "Smartyサンプル6");
$smarty->assign("data", $data);


//ブラウザの種類でテンプレートを切り換え
//環境変数「HTTP_USER_AGENT」でブラウザを判定
$agent = $_SERVER['HTTP_USER_AGENT'];
if(preg_match("/^Mozilla/",$agent) || preg_match("/^Opera/",$agent)){
  //PC系
  $smarty->display("template6_pc.tpl");
}elseif(preg_match("/^SoftBank/",$agent) || preg_match("/^Vodafone/",$agent)){
  //SoftBank携帯
  $smarty->display("template6_mobile.tpl");
}elseif(preg_match("/^DoCoMo/",$agent)){
  //DoCoMo携帯
  $smarty->display("template6_mobile.tpl");
}elseif(preg_match("/^KDDI/",$agent)){
  //au携帯
  $smarty->display("template6_mobile.tpl");
}else{
  //その他
  $smarty->display("template6_etc.tpl");
}
