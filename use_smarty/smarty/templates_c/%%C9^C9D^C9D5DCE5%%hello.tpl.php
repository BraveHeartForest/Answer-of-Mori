<?php /* Smarty version 2.6.31, created on 2019-11-13 02:30:44
         compiled from hello.tpl */ ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World!</title>
</head>
<body>
    <p>Hello <?php echo $this->_tpl_vars['name']; ?>
!</p>
    <ul>
    <?php $_from = $this->_tpl_vars['myColors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['color']):
?>
        <hr>
        <li><?php echo $this->_tpl_vars['key']; ?>
:<?php echo $this->_tpl_vars['color']; ?>
</li>
        <hr>
    <?php endforeach; endif; unset($_from); ?>
    </ul>

    <ul>
    <?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['myId'] => $this->_tpl_vars['i']):
?>
        <li><a href="item.php?id=<?php echo $this->_tpl_vars['myId']; ?>
"><?php echo $this->_tpl_vars['i']['no']; ?>
: <?php echo $this->_tpl_vars['i']['label']; ?>
</a></li>
    <?php endforeach; endif; unset($_from); ?>
    </ul>
    <p>連想配列の場合は&lbrace;$i.no&rbrace;のようにして表現する。</p>
    <pre>
    $items_list = array(23 =&gt; array('no' =&gt; 2456, 'label' =&gt; 'Salad'),
                        96 =&gt; array('no' =&gt; 4889, 'label' =&gt; 'Cream')
                        );
    $smarty-&gt;assign('items', $items_list);

    &lt;ul&gt;
    &lbrace;foreach from=$items key=myId item=i&rbrace;
    <p><b>ここでitem=iは連想配列です。</b></p>
        &lt;li&gt;&lt;a href="item.php?id=&lbrace;$myId&rbrace;"&gt; <b>&lbrace;$i.no&rbrace;: &lbrace;$i.label&rbrace;&lt;</b>/li&gt;
    &lbrace;/foreach&rbrace;
    &lt;/ul&gt;
    </pre>
</body>
</html>