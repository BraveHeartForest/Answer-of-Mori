(function ($) {
    $(document).ready(function () {
        /*
        var elem = document.getElementById("hello");
        elem.style.backgroundColor="#9F9";
        */

        /*
       var elem = $("#hello");
       elem.css("backgroundColor","#9F9");
       */

        var elem = $(".elems");
        elem.each(function () {
            $(this).css("backgroundColor", "#9F9");
        });

        var id_name = $(p).attr("id");  //一番最初のpタグのid名を取得。
        $("#result").html(id_name);

        var id_name = $("p:first").attr("id", "bar");    //id名を変更。

        var contents = $("div:first").html();   //最初のdivの中身を取得
        $("div:eq(1)").html(contents);  //二番目のdivの中身を一番目のものと同じにする。
        /*
        $("p").each(function(){
            $(this).html("Hello world");
        });
        これで全てのpタグの中身がHello worldに書き換えられる。
        */

        //var result = $("#element").css("background-color"); //id名の背景色を取得。
        //rgb(0,0,0)のような形式で出力される

        /*
        var params = {
            "background-color": "#C00",
            "height": "250px",
            "width": "400px"
        }
        $("#element").css(params);  //これでparamsのcssを適用される。
        */

        /*
        $("#element").hide();   //最初は隠れている状態

        $("#btn").click(function(){
            $("#element").show();   //表示する。
        });
        */
    });
})(jQuery);