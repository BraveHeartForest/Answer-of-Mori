<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<TITLE>{$title|escape}：PC版</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div align="center"><font size="5"><b>{$title|escape}：PC版</b></font></div>
<hr width="600" align="center">

<!-- テンプレートへの埋め込み -->
{* PC用コンテンツ *}
{foreach from=$data item=value01 name=loop01}
  <table width="390" border="0" cellspacing="0" cellpadding="7" height="55" align="center">
    <tr>
      <td valign="top" width="40"><img src="../icon.jpg" width="40" height="60" border="0" alt="MySQL"></td>
      <td valign="top" width="350"><font size="2"><b>{$value01.name|escape}</b></font><br>
        <div align="right"><b>￥ {$value01.price|escape}/1個　　</b>
        <b>{$value01.qty|escape}個</b></div>
      </td>
    </tr>
  </table>
{foreachelse}
  表示させるデータがありません。
{/foreach}
</table>

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
