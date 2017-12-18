$(document).ready(function() {

    $('.barss').click(function () {
        $('.navbar-nav').slideToggle();
    });

    var rol = function () {
        if ($('#selectrole').val() != 2) {
            $('#accountInfo').slideDown();
            if($('#oldww').val() == "ja") {
                $('#gbn').prop('readonly', true);
            }
        } else {
            $('#accountInfo').slideUp();
            $('#gbnww').val('');
        }
    };

    var datum = function () {
        if ($('#blogdatum').val() == 1) {
            $('#blogdatuminput').slideDown();
        } else {
            $('#blogdatuminput').slideUp();
            $('#blogdatuminput').val('');
        }
    };

    rol();
    datum();
    $('#selectrole').change(rol);
    $('#blogdatum').change(datum);


});