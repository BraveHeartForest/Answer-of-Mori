<?php

//注文データを追加する命令文は以下の通り

//命令文準備
$sql="INSERT INTO menu ('name','price','contents','comment') VALUES(?,?,?,?)";
//メソッド準備
$stmt=$dbh->prepare($sql);

//代入する数値を準備

$data=array();	//リセット

$data=array(

$post['pro_name'],
$post['price'],
$post['contents'],
$post['comment']
);


//実行
$stmt->execute($data);	//=$dbh->prepare(sql)->execute($data)


//今取得した注文コードをいったん保管します。


//準備
$sql='SELECT LAST_INSERT_ID()';
//メソッド準備
$stmt=$dbh->prepare($sql);
$stmt->execute();

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$lastcode=$rec['LAST_INSERT_ID()']
