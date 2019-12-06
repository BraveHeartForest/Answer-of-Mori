<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello World!</title>
</head>
<body>
    <p>Hello {$name}!</p>
    <ul>
    {foreach from=$myColors item=color key=key}
        <hr>
        <li>{$key}:{$color}</li>
        <hr>
    {/foreach}
    </ul>

    <ul>
    {foreach from=$items key=myId item=i}
        <li><a href="item.php?id={$myId}">{$i.no}: {$i.label}</a></li>
    {/foreach}
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