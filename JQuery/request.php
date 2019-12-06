<?php
header('Content-type: text/plain; charset=UTF-8');
if(isset($_POST['userid'])&& isset($_POST['password'])){
    $id=$_POST['userid'];
    $pas=$_POST['password'];
    $str="AJAX REQUEST SUCCESS\nuserid:".$id."\npassword:".$pas."\n";
    $result=nl2br($str);
    print $result;
}else{
    print "FAIL TO AJAX REQUEST";
}