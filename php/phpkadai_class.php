<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML4.01 Transitional//EN"> <html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>class課題</title>
</head>

<body>
    <?php
    class Cat
    {
      //クラス課題
      private $nakigoe;
      private $esa;
      private $nodo;
      private $age;
      function __construct()
      {
        echo "ねこです<br/>";
        $this->age = 0;
      }
      function nakigoe()
      {
        echo "なく";
      }
      function esa($esa)
      {
        $this->esa = $esa;
        echo "えさ:" . $this->esa . "<br/>";
      }
      function nodo($nodo)
      {
        $this->nodo = $nodo;
        echo "喉の音:" . $this->nodo . "<br/>";
      }
      function Birthday()
      {
        $this->age++;
        return $this->age;
      }
    }
    class Domestic_cat extends Cat
    {
      function sleep()
      {
        echo "寝ています<br/>";
      }
    }
    $mycat = new Cat();
    $mycat->nakigoe();
    $mycat->esa("猫缶");
    $mycat->nodo("ごろごろ");
    $mycat2=new Cat();
    $mycat2->nakigoe('にゃあにゃあ');
    $mycat2->esa('ペレット');
    $mycat2->nodo('ごろにゃん');


    echo     "誕生日" . $mycat->Birthday() . "才<br>";
    echo     "誕生日" . $mycat->Birthday() . "才<br>";
    echo     "誕生日" . $mycat->Birthday() . "才<br>";
    $dome_cat = new Domestic_cat();
    $dome_cat->sleep();
    $dome_cat->nakigoe("にゃあ");
    $dome_cat->esa("猫缶");
    $dome_cat->nodo("ごろごろ");

    ?>
</body>

</html>
