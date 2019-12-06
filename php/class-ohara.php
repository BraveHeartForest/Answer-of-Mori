<?php
Class Cat{
    
    private $age;
    function __construct(){
        $age = "0";
    }
    public function Birthday(){
        $this->age++;
        return $this->age;
    }
}
$myCat = new Cat();

echo $myCat->Birthday() .'歳です。';
echo $myCat->Birthday() .'歳です。';
echo $myCat->Birthday() .'歳です。';

Class Man{
    private $name;
    function __construct($n){
        $this->name = $n;
    }
    function show(){
        echo $this->name;
    }
}
$seito = new Man("渡辺");
$seito->show();

?>