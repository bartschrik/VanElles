$(document).ready(function () {

    /*Elements*/
    $menuToggle     = $('.menuBtn');
    $mobileMenu     = $('#main-menu');
    $subMenuItem    = $('#main-menu > li.has-sub');
    $webtitle       = $('#webtitle').text();
    $webdes       = $('#seo_des').text();
    $webkern       = $('#seo_kern').text();

    /*Vars*/
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('header#main-header').outerHeight();

    /*General*/
    if ($webtitle) {
        document.title = 'Van Elles | ' + $webtitle;
    }
    if ($webdes) {
        $('meta[name=description]').attr('content', $webdes);
    }
    if ($webkern) {
        $('meta[name=keywords]').attr('content', $webkern);
    }


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
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false
    });

    $('#quote-slider').slick({
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false
    });

    $('#product-slide').slick({
        infinite: true,
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
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