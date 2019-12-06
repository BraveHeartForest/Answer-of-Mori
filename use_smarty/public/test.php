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
//テンプレートを格納する場所を指定します。この指定が無いと自動的にtemplates/を格納場所と見なしますが分かり易さを優先し、明示的に定義することが望ましいです。
$smarty->compile_dir = "../smarty/templates_c";
//コンパイル済みテンプレートを格納する場所を指定します。Smartyは毎回テンプレートファイルを解析せずに、一度読み込んでコンパイルされたものを保存し、次回からは変換されたものを読み込んで高速化を図ります。
$smarty->config_dir = "../smarty/configs/";
$smarty->cache_dir = "../smarty/cache/";

//assignメソッドを使ってテンプレートに渡す値を設定
//テンプレート上の変数に対して値を設定することが出来るようになるメソッドです。

$smarty->default_modifiers = array('escape');
/*修飾子を利用したければ、変数に対してその都度修飾子を指定します。ですが escape などは不正な投稿を防ぐためにも、常に設定しておきたいです。
修飾子を毎回指定しても問題ないのですが、それでは少し面倒です。うっかり指定を忘れてしまう可能性もあります。

このような対策に、すべての変数に対して指定した修飾子を、常に適用させることができます。具体的には default_modifiers というプロパティを使用します。
また、修飾子はいくつでも指定することができます。以下は escape と nl2br を指定した例です。

$smarty->default_modifiers = array('escape', 'nl2br');
もし部分的に default_modifiers の指定を無効にしたければ、nofilter を指定します。具体的には

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>サンプル</title>
</head>
<body>
<p>{$test nofilter}</p>
</body>
</html>
このように指定すれば、$test には default_modifiers の指定が適用されません。


他のテンプレートを読み込む
include を使用すると、現在のテンプレートに他のテンプレートを読み込むことができます。例えば header.html というテンプレートを作成し、以下の内容を述しておきます。

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>サンプル</title>
</head>
このテンプレートを読み込むには、以下のようにします。

<html>
{include file='header.html'}
<body>
<p>{$test}</p>
</body>
</html>
このようなテンプレートを作成すると、{include file='header.html'} の部分が header.html の内容に置き換わります。

現在のテンプレートで利用可能なすべての変数は、読み込まれたテンプレートでも利用することができます。これを利用すれば、全ページで共通のヘッダ部分を１つのファイルにまとめたりすることができます。

上手く利用すれば、テンプレートの修正を効率よく行うことができます。
*/

$mes = scandir('./');
//このファイルが存在するディレクトリの内容を読み込み配列として返す。
// $mes = var_dump($mes);
$smarty->assign('mes',$mes);

$smarty->assign('sample',10);

//テンプレートを表示する
$smarty->display("test.tpl");
/*
これの結果は先にtest.tplの結果が表示され、
次にhello.tplの内容が表示される。
但し、hello.tplの方の変数はtest.phpでは定義していないため一切表示されない。
この機能を使えばheader.tpl,...,footer.tplというようにしてパーツを組み上げることでページを作成できる。
$smarty->display("hello.tpl");
*/