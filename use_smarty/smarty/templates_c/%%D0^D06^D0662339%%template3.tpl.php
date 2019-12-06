<?php /* Smarty version 2.6.31, created on 2019-11-15 02:42:40
         compiled from template3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'template3.tpl', 5, false),)), $this); ?>
<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="./style.css">
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
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop01'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop01']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
        $this->_foreach['loop01']['iteration']++;
?>
  <li>キーは「<?php echo ((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
」、値は「<?php echo ((is_array($_tmp=$this->_tpl_vars['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
」</li>
<?php endforeach; else: ?>
  表示させるデータがありません。
<?php endif; unset($_from); ?>
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