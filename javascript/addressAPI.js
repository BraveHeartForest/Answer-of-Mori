function isPostcode(postcode) {
    //郵便番号の形式であるか否かを判定する関数。
    if ((postcode.match(/^\d{3}-?\d{4}$/))) {
        return true;
    } else { return false; }
}

function disp() {
    //XMLHttpRequestオブジェクトの作成
    var request = new XMLHttpRequest();


    var zipcode = window.prompt("郵便番号を入力してください。", "");    //入力ダイアログを表示し、入力内容をzipcodeに格納。
    zipcode = zipcode.trim();
    if (isPostcode(zipcode)) {
        //true
        window.alert("郵便番号の形式にはなっています。");
        //URLを開く
        request.open('GET', 'https://api.zipaddress.net/?zipcode=' + zipcode, true);
        request.responseType = 'json';

        //レスポンスが返って来た時の処理を記述
        request.onload = function () {
            //レスポンスが返ってきたときの処理
            var data = this.response;
            //dataはこのスクリプト（request.onload）で定義されるresponse
            // window.alert(data);
            var target_ul = document.getElementsByTagName("ul");
            //同一のタグは複数存在する可能性があるのでElement(S)であり、配列です。
            with (document) {
                getElementById("info").innerHTML = zipcode + "の住所は以下の通りです。";
                getElementById("pref").innerHTML = "県名: " + data.data.pref;
                getElementById("address").innerHTML = "住所: " + data.data.address;
                getElementById("city").innerHTML = "市名: " + data.data.city;
                getElementById("town").innerHTML = "町名: " + data.data.town;
                getElementById("fulladdress").innerHTML = "フル: " + data.data.fullAddress;
            }
            for (var i = 0; i < target_ul.length; i++) {
                //ulの数が増えたとしても問題ないように設定(target_ul.lengthで要素の個数を取得するため)
                target_ul[i].style.display = "block";
                //全てのul属性のcssのdisplayをblockに変更する。
            }
            // console.log(target_ul); //HTMLCollection[ul]として表示される
            console.log(data);
            //dataをコンソールに表示する。dataはObjectであり、data.dataもObjectであるため
            //{code: 200, data: {…}}
            //以下にdataの一例を挙げる。
            //data:address: "湖南市朝国",city: "湖南市",fullAddress: "滋賀県湖南市朝国",pref: "滋賀県",town: "朝国"
        }

        //リクエストをURLに送信。
        request.send();
    } else {
        //false
        window.alert("郵便番号の形式になっていません。");
    }




}

function disp2() {
    //XMLHttpRequestオブジェクトの作成
    var request = new XMLHttpRequest();


    var zipcode = document.getElementById("enter").value; //テキストボックスに入力されている内容を取得。
    zipcode = zipcode.trim();   //コピペしたときに半角スペースがあって表示できない場合に対応します。
    // console.log(zipcode);
    if (isPostcode(zipcode)) {
        //true
        window.alert("郵便番号の形式にはなっています。");
        //URLを開く
        request.open('GET', 'https://api.zipaddress.net/?zipcode=' + zipcode, true);
        request.responseType = 'json';


        //レスポンスが返って来た時の処理を記述
        request.onload = function () {
            //レスポンスが返ってきたときの処理
            var data = this.response;
            var target_num = document.getElementsByClassName("num");

            // https://chaika.hatenablog.com/entry/2016/06/21/085000
            var array = [];
            Object.keys(data.data).forEach(function (key) {
                var val = this[key];
                // console.log(key,val);
                array.push(val);
            }, data.data);


            console.log(target_num);
            for (var i = 0; i < target_num.length; i++) {
                target_num[i].style.display = "list-item";
                target_num[i].innerHTML = array[i];
                // target_num[i].innerHTML = data.data.str[i];
            }
            target_num[5].style.display = "list-item";
            target_num[5].innerHTML = "入力した郵便番号は【<b>"+zipcode+"</b>】でした。";
            console.log(data);
        }

        //リクエストをURLに送信。
        request.send();
    } else {
        //false
        window.alert("郵便番号の形式になっていません。");
    }
}