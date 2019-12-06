<?php

require_once("C:\/xampp\php\smarty-2.6.28\Smarty.class.php");
//smartyのclassまでの絶対パスを用いて利用することを宣言。
// C:\/としないと"/"が読み込まれて？ パスの指定が上手くいかない。

/*
1. xamppのshellを起動
2. cd C:\xampp\htdocs\mori_folder\Answer-of-mori\use_smarty
3. php -S localhost:9000
4. ブラウザで http://localhost:9000/public/hello.php を表示する。
*/

//smartyのインスタンスを生成。
$smarty = new Smarty();

//テンプレートディレクトリとコンパイルディレクトリを読み込む。
$smarty->template_dir = "../smarty/templates";
$smarty->compile_dir = "../smarty/templates_c";

//assignメソッドを使ってテンプレートに渡す値を設定
$smarty->assign("name","World");

$arr = [
    3=>'red',
    5=>'green',
    4=>'blue'
];
$smarty->assign("myColors",$arr);

$items_list = array(23 => array('no' => 2456, 'label' => 'Salad'),
                    96 => array('no' => 4889, 'label' => 'Cream')
                    );
$smarty->assign('items', $items_list);

//テンプレートを表示する
$smarty->display("hello.tpl");