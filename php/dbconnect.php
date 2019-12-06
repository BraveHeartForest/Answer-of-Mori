<?php
$id = $_POST['id'];
$id = htmlspecialchars($id);

//データベース接続

$host = 'localhost';
$dbname='brave';
$dbuser='root';
$dbpass='';

try{
	$dbh=new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$dbuser,$dbpass,array(PDO::ATTR_EMULATE_PREPARES=>false));
}catch(PDOException $e){
	var_dump($e->getMessage());
	exit;
}

//データ取得

$sql = "SELECT id,name,contents,comment FROM menu WHERE id =?";
$stmt = $dbh->prepare($sql);
$stmt->execute(array($id));

//予め配列を生成しておき、while文で回します。
$memberList = array();	//初期化
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	$memberList[]=array(
		'id'=>$row['id'],
		'name'=>$row['name'],
		'contents'=>$row['contents'],
		'comment'=>$row['comment'],
	);
}

//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);

$dbh = null;	//DBとの接続を切断。