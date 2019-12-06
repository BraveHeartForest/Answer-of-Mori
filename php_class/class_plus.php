<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ここに説明文を書く？">
  <meta name="author" content="ここにサイト制作者の名前を書く？">
  <title>CLASS_PLUS</title>
  <!--CSS-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <!--JS-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!--自作CSS-->
  <style type="text/css">
    p {
      font-size: 20px;
    }


    h1 {}

    h2 {}

    h3 {}
  </style>
</head>

<body>
  <?php

  /*
print'<h1 class="bg-primary"></h1>';
print'<h2 class="bg-success"></h2>';
print'<h3 class="bg-info"></h3>';
print'<p></p>';
print"<p></p>";
*/



  class Goblin
  {
    //プロパティ
    public $hp;
    public $mp;
    public $name;

    //コンストラクタ
    public function __construct($name)
    {
      $this->name = "ゴブリン" . $name;
      $this->hp = rand(1, 20);
      $this->mp = rand(1, 5);
    }

    //メソッド
    public function kougeki()
    {
      echo "{$this->name}は勇者を攻撃";
    }
  }

  $gob1 = new Goblin("A");

  echo $gob1->name . "が出現した。";
  echo "<br>";
  echo $gob1->hp . "のHPを持っている。";
  echo "<br>";
  echo $gob1->mp . "のMPを持っている。";
  echo "<br>";
  echo $gob1->kougeki();
  echo "<br>";


  class Slime
  {
    //プロパティ
    public $hp;
    public $mp;
    public $name;

    //コンストラクタ
    public function __construct($name)
    {
      $this->name = $name;
      $this->hp = rand(1, 20);
      $this->mp = rand(1, 5);
    }

    //メソッド
    public function kougeki()
    {
      echo "{$this->name}は勇者を攻撃";
    }

    public function nigeru()
    {
      echo "{$this->name}は逃げ出した";
    }
  }

  $slime1 = new Slime("スライム");

  echo $slime1->kougeki();
  echo "<br>";
  echo $slime1->nigeru();
  echo "<br>";


  class HoimiSlime extends Slime
  {
    public function hoimi()
    {
      echo "{$this->name}はホイミを使った";
    }

    //親クラスのメソッドを上書き（オーバーライド）
    public function nigeru()
    {
      echo "{$this->name}は飛んで逃げた";
    }
  }


  $hslime1 = new HoimiSlime("ホイミスライム");

  echo $hslime1->kougeki();
  echo "<br>";
  echo $hslime1->hoimi();
  echo "<br>";
  echo $hslime1->nigeru();
  echo "<br>";


  class Goblin2
  {
    //プロパティ
    public $name;
    public static $wamei = "小鬼";
    public static $num = 0;

    //コンストラクタ
    public function __construct()
    {
      self::$num++;
      $this->name = "ゴブリン" . self::$num;
    }

    //staticメソッド
    public static function setumei()
    {
      echo "ゴブリンは最弱のモンスター";
    }
  }

  $gob1 = new Goblin2();
  echo $gob1->name;
  echo "<br>";

  $gob2 = new Goblin2();
  echo $gob2->name;
  echo "<br>";

  abstract class Human
  {
    public $name;
    abstract public function hanasu(); //子クラスで必ず実装させるために、中身を実装しない
  }

  //abstractクラス内で宣言したabstractメソッドは中身を実装せず、子クラスで再定義する必要がある

  //Humanクラスを継承したYusyaクラスを宣言
  class Yusya extends Human
  {
    public function hanasu()
    {
      echo "私は勇者です";
    }
  }

  //Humanクラスを継承したMahoクラスを宣言
  class Maho extends Human
  {
    public function hanasu()
    {
      echo "私は魔法使いです";
    }
  }

  //クラスのインスタンスを生成してメソッドを実行してみる
  $u = new Yusya();
  $u->hanasu();
  echo "<br>";
  $m = new Maho();
  $m->hanasu();


  //剣士インターフェイス
  interface Kensi
  {
    public function tatakau();
  }

  //魔法使いインターフェイス
  interface MahouTukai
  {
    public function jumon();
  }

  //魔法剣士クラスを定義する、KensiとMahouTukaiを継承して実装する
  class MahouKensi implements Kensi, MahouTukai
  {
    public function tatakau()
    {
      echo "剣で戦う";
    }

    public function jumon()
    {
      echo "魔法を使う";
    }
  }

  $mk = new MahouKensi();
  $mk->tatakau();
  echo "<br>";
  $mk->jumon();


  print '<p>https://pg-happy.jp/php-class.html</p>';




  ?>
</body>

</html>