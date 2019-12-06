<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
<p>表示ページを増やすには.phpを使い回し、.tplを都度増やすことです。</p>
    {foreach from=$mes item=item key=key name=name}
        {$item}<hr>
    {/foreach}
    <p>Smartyのビューでのvar_dumpの方法は以下の通りです。</p>
&lbrace;$mes|@var_dump&rbrace;
    <p>{$mes|@var_dump}</p>
    {if $sample == 10}<p>変数sampleは10です。</p>
    {elseif $sample > 5}<p>変数sampleは5より大きいです。</p>
    {else}<p>変数sampleは5以下です。</p>
    {/if}
    <p>{$sample|default:'値はありません。'}</p>
    {* <p>{$test|escape|nl2br}</p> 
    escape 修飾子を指定すると、HTMLを無効にすることができます。
    このように指定すると、先頭の修飾子から順に実行されていきます。*}
</body>
</html>