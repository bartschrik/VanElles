$(document).ready(function() {

    $('.barss').click(function () {
        $('.navbar-nav').slideToggle();
    });

    var test = function () {
        if ($('#selectrole').val() != 2) {
            $('#accountInfo').slideDown();
            console.log($('#oldww').val());
            if($('#oldww').val() == "ja") {
                $('#gbn').prop('readonly', true);
            }
        } else {
            $('#accountInfo').slideUp();
            $('#gbnww').val('');
        }
    };

    test();
    $('#selectrole').change(test);


});