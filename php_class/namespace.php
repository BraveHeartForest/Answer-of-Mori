<?php
namespace MySpace\Sub\Level;

	class MyClass{
		static function staticmethod(){
			//名前空間の表示
			print __NAMESPACE__;
		}
	}

	//被修飾名による指定
	MyClass::staticmethod();
	print"<br>";

	//完全修飾名による指定
	\MySpace\Sub\Level\MyClass::staticmethod();