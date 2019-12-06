<?php
/**
 * /app/View/Hello/terms.ctp
 */

 //フォームヘルパーを用いてフォーム出力
echo $this->Form->create();
echo $this->Form->input('txt');
echo $this->Form->end('Add');
 
//リクエストパラメータを出力
if( $this->request->isPost() ) {
    echo $this->request->data('txt');
}
?>