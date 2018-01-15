$(function(){

    /* Slider */
    if ($('.slider').length != 0) {
        var owl = $('.slider');

        owl.on('initialized.owl.carousel', function(event){
            $('.owl-item.active').find('.sliderContenu').addClass('active');
        });

        owl.owlCarousel({
            items: 1,
            responsiveRefreshRate: 10,
            nav: true,
            autoplay: true,
            autoplaySpeed: 2000,
            autoplayTimeout: 8000,
            navSpeed: 800,
            margin:30,
            navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
        });

        owl.on('translate.owl.carousel', function() {
            $('.owl-item .sliderContenu').removeClass('active');
        });

        owl.on('translated.owl.carousel', function(event) {
            $('.owl-item.active').find('.sliderContenu').addClass('active');
        });
    }

});