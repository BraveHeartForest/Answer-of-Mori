<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="./style.css">
<TITLE>{$title|escape}</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div class="center"><font size="5"><b>{$title|escape}</b></font></div>
<hr width="600" class="center">

<!-- テンプレートへの埋め込み -->
<div class="center">
{* 配列の利用 *}
{foreach from=$data item=value name=loop01}
  <li>値は「{$value|escape}」</li>
{foreachelse}
  表示させるデータがありません。
{/foreach}
</div>

<!-- フッター -->
<hr width="600" class="center">
<table width="600" border="0" class="center">
<tr>
<td class="right"><font size="2">＠ＩＴ LinuxSquare「今から始める MySQL入門」<br>
2007/09/17作成</font></td>
</tr>
</table>

</BODY>
</HTML>
