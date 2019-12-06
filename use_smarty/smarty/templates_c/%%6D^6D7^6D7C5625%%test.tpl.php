<?php /* Smarty version 2.6.31, created on 2019-11-14 09:28:19
         compiled from test.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'test.tpl', 11, false),array('modifier', 'var_dump', 'test.tpl', 16, false),array('modifier', 'default', 'test.tpl', 21, false),)), $this); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
<p>表示ページを増やすには.phpを使い回し、.tplを都度増やすことです。</p>
    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['mes'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['name'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['name']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['name']['iteration']++;
?>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['item'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<hr>
    <?php endforeach; endif; unset($_from); ?>
    <p>Smartyのビューでのvar_dumpの方法は以下の通りです。</p>
&lbrace;$mes|@var_dump&rbrace;
    <p><?php echo var_dump(((is_array($_tmp=$this->_tpl_vars['mes'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp))); ?>
</p>
    <?php if (((is_array($_tmp=$this->_tpl_vars['sample'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)) == 10): ?><p>変数sampleは10です。</p>
    <?php elseif (((is_array($_tmp=$this->_tpl_vars['sample'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)) > 5): ?><p>変数sampleは5より大きいです。</p>
    <?php else: ?><p>変数sampleは5以下です。</p>
    <?php endif; ?>
    <p><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['sample'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('default', true, $_tmp, '値はありません。') : smarty_modifier_default($_tmp, '値はありません。')); ?>
</p>
    </body>
</html>