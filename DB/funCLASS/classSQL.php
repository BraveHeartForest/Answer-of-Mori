<?php
//https://qiita.com/ara-bot/items/36946bb10ef25261e814
//https://qiita.com/7968/items/6f089fec8dde676abb5b	解説としてオススメ
//https://gray-code.com/php/create-table-by-using-pdo/
//https://ponk.jp/php/basic/php_mysql

//https://qiita.com/BRS_matsuoka/items/ebcc8ab655bb373e36c7	本文はこれを参考に作られている

class Connect
{

	//定数の宣言

	const DB_NAME = 'brave';	//今回接続するデータベース名
	const HOST = 'localhost';
	const UTF = 'utf8';
	const USER = 'root';	//データベースのユーザー名（任意）今回はuserということにしている。
	const PASS = '';	//ユーザーのパスワード（任意）今回はないものとしている。




	//データベースに接続するメソッドを定義する。

	public function dbh()
	{

		$dsn = "mysql:dbname=" . self::DB_NAME . ";host=" . self::HOST . ";charset=" . self::UTF;
		$user = self::USER;
		$pass = self::PASS;
		try {
			$dbh = new PDO($dsn, $user, $pass);
			//print"接続に成功しました。\n<br>";
		} catch (Exception $e) {
			print '接続失敗：' . $e->getMessage() . "<br>\n";
			exit();
		}
		//エラーの結果を表示します。
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		return $dbh;
	}	//メソッドdbh閉じる。


	//SELECT,INSERT,UPDATE,DELETE文のときに使用するメソッド
	public function plural($sql, $item)
	{

		$start = $this->dbh();
		$stmt = $start->prepare($sql);
		$stmt->execute($item);
		$dbh = null;	//接続を切断する。
		return $stmt;
	}



	/*失敗作。用途不明
	public function lastID(){

		$sql='SELECT_LAST_INSERT_ID()';
		$start = $this -> dbh();
		$stmt = $start -> prepare($sql);
		$stmt -> execute();
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$lastcode=$rec['LAST_INSERT_ID()'];
		return $lastcode;
	}
*/
}	//class閉じる。

/*
[MySQL] AUTO_INCREMENTの番号を振り直す方法
http://www.searchlight8.com/mysql-auto-increment-renew/

*/
