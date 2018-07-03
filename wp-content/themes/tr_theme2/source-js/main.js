jQuery(document).ready(function(){
    jQuery('.banner-slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: true,
        adaptiveHeight: false,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000
});

    jQuery('.testemonials-slider').slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: true,
        adaptiveHeight: true,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: '<i class="fas fa-chevron-right"></i>',
        prevArrow: '<i class="fas fa-chevron-left"></i>',
    });

    // if (jQuery('li.show-text a.tab-link').hasClass('active', 'show')) {
    //     jQuery('.li.show-text .tab-content').show();
    // }

    jQuery('.wpsw-social-links').addClass('d-flex flex-row justify-content-center align-items-center flex-wrap');
    jQuery('.instagram-pics').addClass('d-flex flex-row justify-content-center align-items-center flex-wrap')
});

