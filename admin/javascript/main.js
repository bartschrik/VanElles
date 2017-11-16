$(document).ready(function() {

    $('.barss').click(function () {
        $('.navbar-nav').slideToggle();
    });

    var test = function () {
        if ($('#selectmodule').val() == 7) {
            $('#studentlink').slideDown();
        } else {
            $('#studentlink').slideUp();
        }
    };

    test();
    $('#selectmodule').change(test);
});