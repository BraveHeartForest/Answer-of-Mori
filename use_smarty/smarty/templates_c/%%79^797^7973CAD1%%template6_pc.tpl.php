<?php /* Smarty version 2.6.31, created on 2019-11-15 04:02:30
         compiled from template6_pc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'template6_pc.tpl', 4, false),)), $this); ?>
<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<TITLE><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
：PC版</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="white">

<!-- タイトル -->
<div align="center"><font size="5"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
：PC版</b></font></div>
<hr width="600" align="center">

<!-- テンプレートへの埋め込み -->
<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['loop01'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['loop01']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['value01']):
        $this->_foreach['loop01']['iteration']++;
?>
  <table width="390" border="0" cellspacing="0" cellpadding="7" height="55" align="center">
    <tr>
      <td valign="top" width="40"><img src="../icon.jpg" width="40" height="60" border="0" alt="MySQL"></td>
      <td valign="top" width="350"><font size="2"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['value01']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b></font><br>
        <div align="right"><b>￥ <?php echo ((is_array($_tmp=$this->_tpl_vars['value01']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/1個　　</b>
        <b><?php echo ((is_array($_tmp=$this->_tpl_vars['value01']['qty'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
個</b></div>
      </td>
    </tr>
  </table>
<?php endforeach; else: ?>
  表示させるデータがありません。
<?php endif; unset($_from); ?>
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