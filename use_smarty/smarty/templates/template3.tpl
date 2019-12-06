<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="./style.css">
<TITLE>{$title|escape}</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div align="center"><font size="5"><b>{$title|escape}</b></font></div>
<hr width="600" align="center">

<!-- テンプレートへの埋め込み -->
<div align="center">
{* 連想配列の利用 *}
{foreach from=$data key=key item=value name=loop01}
  <li>キーは「{$key|escape}」、値は「{$value|escape}」</li>
{foreachelse}
  表示させるデータがありません。
{/foreach}
</div>

<!-- フッター -->
<hr width="600" align="center">
<table width="600" border="0" align="center">
<tr>
<td align="right"><font size="2">＠ＩＴ LinuxSquare「今から始める MySQL入門」<br>
2007/09/17作成</font></td>
</tr>
</table>

</BODY>
</HTML>
