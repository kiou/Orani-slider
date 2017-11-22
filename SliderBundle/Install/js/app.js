$(function(){

    /* Slider */
    if ($('.slider').length != 0) {
        $('.slider').owlCarousel({
            items: 1,
            responsiveRefreshRate: 10,
            nav: true,
            autoplay: true,
            autoplaySpeed: 2000,
            autoplayTimeout: 5000,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        });
    }

});