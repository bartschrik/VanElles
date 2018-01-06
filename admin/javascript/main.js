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


    $( ".sortable" ).sortable({
        placeholder: "ui-state-highlight",
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();
        }
    });
    
    function sendOrderToServer () {
        var order = $(".sortable").sortable("serialize");

        $.ajax({
            type: "POST", dataType: "json", url: "sortPage.php",
            data: order,
            success: function(response) {
                if (response.status == "success") {
                    console.log("Sort success");
                } else {
                    alert('Some error occurred');
                }
            },
            error: function (response) {
                console.log(response.responseText);
            }
        });
    }

    //$( ".sortable" ).disableSelection();


});