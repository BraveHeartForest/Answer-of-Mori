<?php /* Smarty version 2.6.31, created on 2019-11-15 03:47:47
         compiled from template4.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'template4.tpl', 8, false),)), $this); ?>


<!-- テンプレートへの埋め込み -->
<div align="center">
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop01'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop01']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value01']):
        $this->_foreach['loop01']['iteration']++;
?>
  <?php $_from = $this->_tpl_vars['value01']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop02'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop02']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value02']):
        $this->_foreach['loop02']['iteration']++;
?>
    <?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
:<?php echo ((is_array($_tmp=$this->_tpl_vars['value02'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
,
  <?php endforeach; endif; unset($_from); ?>
    <br>
<?php endforeach; else: ?>
  表示させるデータがありません。
<?php endif; unset($_from); ?>
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