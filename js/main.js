$(document).ready(function () {

    /*Elements*/
    $menuToggle     = $('.menuBtn');
    $mobileMenu     = $('#main-menu');
    $subMenuItem    = $('#main-menu > li.has-sub');

    /*Vars*/
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header#main-header').outerHeight();

    /*General*/


    /*Menu*/
    $menuToggle.click(function () {
        $(this).stop().toggleClass('active');
        $mobileMenu.slideToggle('fast');
    });
    $subMenuItem.click(function () {
        if(!$(this).hasClass('active')) {
            $subMenuItem.removeClass('active');
            $subMenuItem.find('ul').slideUp('fast');
        }
        $(this).stop().toggleClass('active');
        $(this).find('ul').slideToggle('fast');
        return false;
    });


    /*Sliders*/
    $('#main-slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false
    });


    /*Scroll function*/
    $(window).scroll(function(event){
        didScroll = true;
    });
    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);
    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if(Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            $('body').addClass("scrolledft");
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('body').removeClass("scrolledft");
            }
        }

        lastScrollTop = st;
    }

});