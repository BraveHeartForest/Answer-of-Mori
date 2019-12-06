<?php
Class Shop{
    public $name;
    public $price;
    public function sayItem(){
        print
        "アイテム：".$this->name. "値段（税込）：".$this->price * 1.08.";";
    }
}

$shirts = new Shop();
$shirts->name = "シャツ";
$shirts->price = 1000;

$shoes = new Shop();
$shoes->name = "シューズ";
$shoes->price = 3000;

$shirts->sayItem();
$shoes->sayItem();

?>