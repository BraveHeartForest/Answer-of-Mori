<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page</title>
</head>
<body> -->
<h1>Index Page</h1>
<p>this is test View.</p>
<p><?php print @$result; ?></p>
<p>message: <?php print $msg; ?></p>
<br>
<p>Data.</p>
<div>
  <ul>
    <?php foreach($datas as $data): ?>
    <li><?php print $data; ?></li>
    <?php endforeach; ?>
    </ul>
</div>
<!-- <p>
  <form method="post" action="./form" name="form1">
    <div><input type="text" name="text1" id="text1"></div>
    <div><input type="checkbox" name="check1" id="check1">
    <label for="check1">check1</label></div>
    <div><input type="radio" value="radio_A"
      name="radio1" id="radio_a">
    <label for="radio_a">Radio A</label>
    <input type="radio" value="radio_B"
      name="radio1" id="radio_b">
    <label for="radio_b">Radio B</label></div>
    <div><input type="submit" value="送る">
  </form>
</p> -->
<p>
    <?php
    print $this ->Form->create(false,array(
        'type'=>'post',
        'action'=>'.',
    )); //2.1ではnullではなくfalseにしないといけない。
    print $this->Form->text('text1')."<br>";
    print $this->Form->checkbox('check1')."<br>";
    print $this->Form->label('check1',"checkbox1")."<br>";
    print $this->Form->radio('radio1', 
        array('male' => '男性', 
          'female' => '女性'));
    print $this->Form->select('select1',
        array("Mac" => 'マック',
          "Windows" => 'ウインドウズ',
          "Linux" => 'リナックス'));
    print"<br>";
    print $this->Form->end("送信");
    //フォームの終了end(送信ボタンのテキスト);
    ?>
</p>
<!-- </body>
</html> -->