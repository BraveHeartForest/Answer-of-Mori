<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<TITLE>{$title|escape}：携帯版</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div align="center"><font size="3"><b>{$title|escape}<br>（携帯版）</b></font></div>
<hr width="100%" align="center">

<!-- テンプレートへの埋め込み -->
{* 携帯コンテンツ *}
{foreach from=$data item=value01 name=loop01}
  <table border="0" align="center" width="100%">
    <tr>
      <td  width="20" height="30" valign="top"><img src="icon_mini.jpg" width="20" height="30" border="0"></td>
      <td align=left><font size="2"><b>{$value01.name|escape}</b></font><br>
        <div align="right"><b>￥{$value01.price|escape}/1個 </b>
        <b>{$value01.qty|escape}個</b></div>
      </td>
    </tr>
  </table>
{foreachelse}
  表示させるデータがありません。
{/foreach}
</table>

<!-- フッター -->
<hr width="100%" align="center">
<table width="100%" border="0" align="center">
<tr>
<td align="right"><font size="1">＠ＩＴ LinuxSquare「今から始める MySQL入門」<br>
2007/09/17作成</font></td>
</tr>
</table>

</BODY>
</HTML>
