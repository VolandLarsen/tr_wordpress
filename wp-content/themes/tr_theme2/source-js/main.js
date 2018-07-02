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
        adaptiveHeight: false,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 2000
    });

    if (jQuery('li.show-text a.tab-link').hasClass('active', 'show')) {
        jQuery('.li.show-text .tab-content').show();
    }
});

