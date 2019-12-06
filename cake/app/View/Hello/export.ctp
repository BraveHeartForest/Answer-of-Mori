<?php
/**
 * /app/View/Hello/other.ctp
 */
 
//「post」という名前の変数がセットされていたら値を表示
if(isset($post)) {
    echo $post;
}