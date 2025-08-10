(function ($) {
    "use strict";

    $(document).ready(function($){

$(document).ready(function() {
    console.log('Testimonials found:', $(".testimonial-sliders").length);
    if ($(".testimonial-sliders").length > 0) {
        $(".testimonial-sliders").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000, // 5 seconds per slide
            autoplayHoverPause: true, // pause on hover
            smartSpeed: 800, // transition speed
            dots: true, // show pagination dots
            nav: false, // no next/prev arrows
            rtl: true, // important for RTL layout
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    nav: false,
                    loop: true
                }
            }
        });
    } else {
        console.log('No testimonials found!');
    }
});

        // homepage slider
    $(".homepage-slider").owlCarousel({
    items: 1,
    loop: false,
    autoplay: false,
    nav: false, // ❌ remove arrows
    dots: false,
    responsive:{
        0:{
            items:1,
            nav:false,
            loop:false
        },
        600:{
            items:1,
            nav:false,
            loop:false
        },
        1000:{
            items:1,
            nav:false,
            loop:false
        }
    }
});


        // logo carousel
        $(".logo-carousel-inner").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            margin: 30,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:false,
                    loop:true
                }
            }
        });

        // count down
        if($('.time-countdown').length){
            $('.time-countdown').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            console.log('Countdown date:', finalDate);
            console.log('Current date:', new Date());
            console.log('Parsed countdown date:', new Date(finalDate));
            $this.countdown(finalDate, function(event) {
                console.log('Countdown update:', event.strftime('%D days, %H hours, %M minutes, %S seconds'));
                var $this = $(this).html(event.strftime('' + '<div class="counter-column"><div class="inner"><span class="count">%D</span>أيام</div></div> ' + '<div class="counter-column"><div class="inner"><span class="count">%H</span>ساعات</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%M</span>دقائق</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%S</span>ثواني</div></div>'));
            });
         });
        }

        // projects filters isotop
        $(".product-filters li").on('click', function () {

            $(".product-filters li").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr('data-filter');

            $(".product-lists").isotope({
                filter: selector,
            });

        });

        // isotop inner
        $(".product-lists").isotope();

        // magnific popup
        $('.popup-youtube').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        // light box
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });

        // homepage slides animations
        $(".homepage-slider").on("translate.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").removeClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });

        $(".homepage-slider").on("translated.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").addClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });



        // stikcy js
        $("#sticker").sticky({
            topSpacing: 0
        });

        //mean menu
        $('.main-menu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "992"
        });

         // search form
        $(".search-bar-icon").on("click", function(){
            $(".search-area").addClass("search-active");
        });

        $(".close-btn").on("click", function() {
            $(".search-area").removeClass("search-active");
        });

    });


    jQuery(window).on("load",function(){
        jQuery(".loader").fadeOut(1000);
    });


}(jQuery));
