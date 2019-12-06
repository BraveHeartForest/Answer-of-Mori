<h1>いま何時？</h1>
<?php
   //createでフォームを宣言
   echo $this->Form->create('Aisatsu',array(
      'type' => 'post', //type属性を指定
      'url' => 'show' 
      //↑アクションを指定。submitが押されるとこのアクションへ値が渡される。今回の場合、showアクションへ値が渡る。
   ));

   //inputでフォーム作成。type属性を指定すればいろいろなフォームが作れる。無指定だとtextになる。
   echo $this->Form->input('Aisatsu.zikan',array(
      'label' => '時間'
   ));

   //submitボタン作成
   echo $this->Form->submit();

   //フォーム宣言終わり。書かなくてもいい。
   echo $this->Form->end();
?>