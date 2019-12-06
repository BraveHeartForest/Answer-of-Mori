<?php
/**DBクラス
 * 定数
 * 			:DSN............データベース接続情報
 * 			:USR............ユーザ名
 * 			:PASSWORD.......パスワード
 * 			:SQL~...........それぞれメソッドで使用するSQL文
 * 			:ERROR_MESSAGE..try-catchで障害が発生した場合のエラーメッセージ
 * メソッド 
 *		  :DB_PRICE_BETWEEN().......................下限価格~上限価格の間で検索
 *			:DB_SELECT_ALL()..........................何も入力されていない場合、全件検索
 *			:DB_SELECT_NAME_LIKE()....................商品名のみ検索
 *			:DB_SELECT_NAME_LIKE_AND_PRICE_BETWEEN()..全て入力された場合の検索
 * 		  :DB_select_id()...........................更新,削除が押された際にmenuテーブルから一意のレコードを抽出
 * 		  :DB_edit_done()...........................menuテーブルのレコード更新
 * 		  :DB_touroku().............................menuテーブルへのレコード追加
 * 		  :DB_delete()..............................menuテーブルからレコード削除
 * 
 */
class DB {
	const DSN = "mysql:dbname=takano;host=localhost;charset=utf8";
	const USER = "root";
	const PASSWORD = "";
	const SQL_SELECT_PRICE_BETWEEN = "SELECT * FROM menu WHERE price BETWEEN ? AND ?";
	const SQL_SELECT_ALL = "SELECT * FROM menu WHERE 1";
	const SQL_SELECT_NAME_LIKE = "SELECT * FROM menu WHERE name LIKE ? ";
	const SQL_SELECT_NAME_LIKE_AND_PRICE_BETWEEN = "SELECT * FROM menu WHERE name LIKE ? AND price BETWEEN ? AND ?";
	const SQL_SELECT_ID = "SELECT name,price,contents,comment FROM menu WHERE id=?";
	const SQL_UPDATE = "UPDATE menu SET name=?,price=?,contents=?,comment=? WHERE id=?";
	const SQL_INSERT = "INSERT INTO menu(name,price,contents,comment) VALUES (?,?,?,?)";
	const SQL_DELETE = "DELETE FROM menu WHERE id=?";
	const ERROR_MESSAGE = 'ただいま障害により大変ご迷惑をお掛けしております。';
	
	public static function DB_PRICE_BETWEEN($price_search1,$price_search2) {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_SELECT_PRICE_BETWEEN);
			$data = [$price_search1,$price_search2];
			$stmt->execute($data);
			$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pdo = null;
			return $fetch;	
		} catch(Exception $e) {
			$e -> getmessage(); 
			print self::ERROR_MESSAGE.'<br /><br />'.$e;
			exit();
		}
	}	
	public static function DB_SELECT_ALL() {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_SELECT_ALL);
			$stmt->execute();
			$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pdo = null;
			return $fetch;	
		} catch(Exception $e) {
			$e -> getmessage(); 
			print self::ERROR_MESSAGE.'<br /><br />'.$e;
			exit();
	    }
	} 
	public static function DB_SELECT_NAME_LIKE($name_search) {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_SELECT_NAME_LIKE);
			$data = ['_%'.$name_search.'%_'];
			$stmt->execute($data);
			$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pdo = null;
			return $fetch;
		} catch(Exception $e) {
			$e -> getmessage(); 
			print self::ERROR_MESSAGE.'<br /><br />'.$e;
			exit();
	    }
	} 
	public static function DB_SELECT_NAME_LIKE_AND_PRICE_BETWEEN($name_search,$price_search1,$price_search2) {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_SELECT_NAME_LIKE_AND_PRICE_BETWEEN);
			$data = ['_%'.$name_search.'%_',$price_search1,$price_search2];
			$stmt->execute($data);
			$fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$pdo = null;
			return $fetch;
		} catch(Exception $e) {
			$e -> getmessage(); 
			print self::ERROR_MESSAGE.'<br /><br />'.$e;
			exit();
	    }
	}
	public static function DB_select_id($id) {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_SELECT_ID);
			$data = [$id];
			$stmt->execute($data);
			$fetch = $stmt->fetch(PDO::FETCH_ASSOC);
			$pdo = null;
			return $fetch;
		} catch(Exception $e) {
			$e -> getmessage(); 
			print self::ERROR_MESSAGE.'<br /><br />'.$e;
			exit();
	    }
	}
	public static function DB_edit_done($name,$price,$contents,$comment,$id) {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_UPDATE);
			$data = [$name,$price,$contents,$comment,$id];
			$stmt->execute($data);
			$pdo = null;
			return 1;
		} catch(Exception $e) {
			$e -> getmessage(); 
			$error_massage = self::ERROR_MESSAGE.'<br /><br />'.$e;
			return $error_massage;
	    }
	}
	public static function DB_touroku($name,$price,$contents,$comment) {
		try {
			$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$stmt = $pdo->prepare(self::SQL_INSERT);
			$data = [$name,$price,$contents,$comment];
			$stmt->execute($data);
			$pdo = null;
			return 1;
		} catch(Exception $e) {
			$e -> getmessage(); 
			$error_massage = self::ERROR_MESSAGE.'<br /><br />'.$e;
			return $error_massage;
		}
	}
	public static function DB_delete($id) {
		try {
		$pdo = new PDO(self::DSN,self::USER,self::PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare(self::SQL_DELETE);
		$data = [$id];
		$stmt->execute($data);
		$pdo = null;
		return 1;
		} catch(Exception $e) {
			$e -> getmessage(); 
			$error_massage = self::ERROR_MESSAGE.'<br /><br />'.$e;
			return $error_massage;
		}
	}
}
?>
