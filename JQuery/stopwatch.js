window.onload = function () {
    var time = 180; //初期値
    var counter;
    var min = document.getElementById("min");
    var sec = document.getElementById("sec");
    var start = document.getElementById("start");
    var stop = document.getElementById("stop");
    var reset = document.getElementById("reset");

    start.onclick = function () {
        toggle();   //下の自作関数
        counter = setInterval(count, 1000); //counterの値を1000ミリ秒に一度count関数（自作）で変化させる。
    }

    stop.onclick = function () {
        toggle();  //下の自作関数
        clearInterval(counter);
    }

    reset.onclick = function () {
        time = 180; //初期値に戻す。
        sec.innerHTML = time % 60;
        min.innerHTML = Math.floor(time / 60);  //60で割ったときの切り上げを埋め込む。
    }

    function toggle() {
        if (start.disabled) {
            start.disabled = false; //startボタンが押せない、を否定。
            stop.disabled = true;   //stopボタンが押せない、を肯定。
        } else {
            start.disabled = true
            stop.disabled = false;
        }
    }

    function count() {
        if (time === 0) {
            sec.innerHTML = 0;
            min.innerHTML = 0;
            toggle();
            alert("3分経過しました。");
            clearInterval(counter); //counterの変化を停止。
        } else {
            time -= 1;  //timeの値を-1する。
            sec.innerHTML = time % 60;
            min.innerHTML = Math.floor(time / 60);
        }
    }

}