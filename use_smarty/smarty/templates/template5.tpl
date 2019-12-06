<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<TITLE>{$title|escape}</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div align="center"><font size="5"><b>{$title|escape}</b></font></div>
<hr width="600" align="center">

<!-- テンプレートへの埋め込み -->
<div align="center">
{* 連想配列の利用 *}
<table border="1" cellpadding="3" cellspacing="0">
  <tr><th>名前</th>
      <th>価格</th>
      <th>在庫数</th>
  </tr>
{foreach from=$data item=value01 name=loop01}
  <tr><td>{$value01.name|escape|default:'name'}</td>
      <td>{$value01.price|escape|default:'price'}</td>
      <td>{$value01.qty|escape|default:'qty'}</td>
  </tr>
{foreachelse}
  表示させるデータがありません。
{/foreach}
</table>
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
