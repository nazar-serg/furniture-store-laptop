jQuery(document).ready(function ($) {
    $('.product-content-wrapper__image-carousel').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        dots: false,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        navText: [
            '<span class="owl-prev owl-custom-prev-single-product">‹</span>',
            '<span class="owl-next owl-custom-next-single-product">›</span>'
        ],
    });
});
