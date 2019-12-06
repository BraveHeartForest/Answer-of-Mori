

<!-- テンプレートへの埋め込み -->
<div align="center">
{* 連想配列の利用 *}
{foreach from=$data item=value01 name=loop01}
  {foreach from=$value01 key=key item=value02 name=loop02}
    {$key|escape}:{$value02|escape},
  {/foreach}
    <br>
{foreachelse}
  表示させるデータがありません。
{/foreach}
</div>
<div>
<pre>
$data = array(
    array("name"=>"MySQL","price"=>"850円","qty"=>"5"),
    array("name"=>"BIND9","price"=>"780円","qty"=>"4"),
    array("name"=>"Apache","price"=>"480円","qty"=>"7")
    );

&lbrace;foreach from=$data item=value01 name=loop01&rbrace;
  &lbrace;foreach from=$value01 key=key item=value02 name=loop02&rbrace;
    &lbrace;$key|escape&rbrace;:&lbrace;$value02|escape&rbrace;,
  &lbrace;/foreach&rbrace;
    &lt;br&gt;
&lbrace;foreachelse&rbrace;
  表示させるデータがありません。
&lbrace;/foreach&rbrace;
</pre>
</div>
<p>結果は……</p>
<div><pre>
name:MySQL, price:850円, qty:5,
name:BIND9, price:780円, qty:4,
name:Apache, price:480円, qty:7,

value01[0]=array("name"=>"MySQL","price"=>"850円","qty"=>"5")
...
value01[2]=array("name"=>"Apache","price"=>"480円","qty"=>"7")

∴ key=[name,price,qty] & value02=[?,?,?]
</pre></div>

</BODY>
</HTML>
