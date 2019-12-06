/*window.onload = function () {
    var now = null;
    max = 100;
    input_area = document.getElementById("text_area");
    output_area = document.getElementById("text_length");

    input_area.onkeyup = function () {
        now = (max - input_area.value.length);
        output_area.innerText = now;
        output_area.className = (now < 0) ? "out" : ""; //nowが0未満ならばclassにoutを記述。
    }
}*/

(function ($) {
    $(function () {
        function logEvent(event) {
            $('#log').prepend($('<li>').text(event.type + ' is occured.'));
        }

        $('#button').on('click', function (event) {
            logEvent(event);
        });

        $('#button').on('dblclick', function (event) {
            logEvent(event);
        });

        $('#button').on('mouseenter', function (event) {
            $('#button').addClass('active');
            logEvent(event);
        });

        $('#button').on('mouseleave', function (event) {
            $('#button').removeClass('active');
            logEvent(event);
        });

        $('#input').on('keypress', function (event) {
            if (event.which === 13) {
                logEvent(event);
            }
        });
    });
})(jQuery);