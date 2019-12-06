<?php /* Smarty version 2.6.31, created on 2019-11-15 03:56:16
         compiled from template5.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'template5.tpl', 4, false),array('modifier', 'default', 'template5.tpl', 21, false),)), $this); ?>
<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<TITLE><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div align="center"><font size="5"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b></font></div>
<hr width="600" align="center">

<!-- テンプレートへの埋め込み -->
<div align="center">
<table border="1" cellpadding="3" cellspacing="0">
  <tr><th>名前</th>
      <th>価格</th>
      <th>在庫数</th>
  </tr>
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop01'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop01']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value01']):
        $this->_foreach['loop01']['iteration']++;
?>
  <tr><td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value01']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'name') : smarty_modifier_default($_tmp, 'name')); ?>
</td>
      <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value01']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'price') : smarty_modifier_default($_tmp, 'price')); ?>
</td>
      <td><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['value01']['qty'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, 'qty') : smarty_modifier_default($_tmp, 'qty')); ?>
</td>
  </tr>
<?php endforeach; else: ?>
  表示させるデータがありません。
<?php endif; unset($_from); ?>
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