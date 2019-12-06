<?php
class Calendar{
	
	private $year;	//クラス外からは影響を受けない
	private $month;	//クラス外からは影響を受けない

	public function __construct($y,$m)
	{
		$this->year = $y;	//インスタンス作成時に入力した”年”をこのインスタンスでの年として使う。
		$this->month = $m;
	}
	
	public static function init_row(){
		$ary = array();
		//配列を初期化
		for($i=0;$i<=6;$i++){
			$ary[]="・";
			//0~6までに・を入力。後でこれを上書きしていく
		}
		return $ary;
	}

	public function get_info(){
		return $this->year."-".$this->month;
	}



	public function create_rows(){
		$last_day = date("j",mktime(0,0,0,$this->month+1,0,$this->year));
		//(時 = 0, 分 = 0, 秒 = 0, 月 = 入力月+1, 日 = 0日, 年 = 入力年,)のときの日数

		$rows = array();	//初期化
		$row = self::init_row();	//count($row)が7になるように初期化

		for($i =1;$i<=$last_day;$i++){

			$date = date("w",mktime(0,0,0,$this->month,$i,$this->year));
			//(時 = 0, 分 = 0, 秒 = 0, 月 = 入力月, 日 = i日, 年 = 入力年,)のときの曜日
			$row[$date] = $i;
			//配列$rowの曜日に対応する分に対して1から順に$iを代入。

			if($date==6||$i ==$last_day){
				//$date==6つまり土曜日、もしくはiが月の最終日まで到達したならば
				$rows[]=$row;
				//$rowsの要素として$rowを追加する。
				// ある値や配列を 他の配列に追加する場合は、「[]=」という演算子を使用します。
				$row = self::init_row();
				//最終日ならばforが終わるが、そうでないならばもう一度$rowを初期状態に戻す。
			}
		}
		return $rows;
	}

}