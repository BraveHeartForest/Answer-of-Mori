<?php /* Smarty version 2.6.31, created on 2019-11-15 03:22:54
         compiled from title.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'title.tpl', 4, false),)), $this); ?>
<HTML lang="ja">
<HEAD>
<META http-equiv="content-type" content="text/html; charset=UTF-8">
<TITLE><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</TITLE>
</HEAD>
<BODY TEXT="black" BGCOLOR="aliceblue">


<!-- タイトル -->
<div align="center"><font size="5"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</b></font></div>
<hr width="600" align="center">