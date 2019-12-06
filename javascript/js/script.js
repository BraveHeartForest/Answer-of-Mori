function appleChange(bool){
	if(bool===0){
		document.getElementById("apple").innerHTML="産地：青森県<br>糖度：13度";
	}else{
		document.getElementById("apple").innerHTML="ここが書き換えられる。";
	}
}

function ageCheck(age){
	if(!isNaN(age)){
		//isNanではnullなどの処理ができない。正規表現が望ましいが失敗
		if(age>=20){
			alert("成人です。");
		}else if(age<0){
			alert("まだ生まれていません");
		}else{
			alert("未成年です。");
		}
	}else{
		alert("正しく入力してください。");
	}

}