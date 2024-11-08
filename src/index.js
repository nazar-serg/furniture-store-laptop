import AOS from 'aos';
import 'owl.carousel';
import './js/menu';
import './js/animation.js';
import './js/scripttotop';
import './js/more-less-content.js';
import './js/mini-cart.js';
import './js/variation-product.js';
import './js/product-image.js';
import './js/search-container.js';
import './js/review-form.js';
import './js/modal-cart.js';
import './js/btn-to-up.js';
import './js/faq-accordion.js';
import './js/customer-reviews.js';
import './js/load-more-products.js';
import './scss/main.scss';


//AOS animation
AOS.init({
    once: true, 
});

jQuery(document).ready(function($) {

       //owl-carousel
       $(".owl-carousel-full").owlCarousel({
        margin: 20,
        items: 4,
        nav: false,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1000: {
                items: 3,
            },
            1200: {
                items: 4
            }
        }
    });
    
     // Добавляем обработчики событий для пользовательских кнопок
     $('.custom-nav-hit-product .prev').click(function() {
        $('.owl-carousel').trigger('prev.owl.carousel');
    });

    $('.custom-nav-hit-product .next').click(function() {
        $('.owl-carousel').trigger('next.owl.carousel');
    });

    //Add ajax loader for product card
    // https://gist.github.com/bagerathan/2b57e7413bfdd09afa04c7be8c6a617f
      $('body').on('adding_to_cart', function (e, btn, data) {
        btn.closest('.product-card').find('.custom-ajax-loader').fadeIn();
    });

    $('body').on('added_to_cart', function (e, response_fragments, response_cart_hash, btn) {
        btn.closest('.product-card').find('.custom-ajax-loader').fadeOut();
    });

    $('main.main').on('click', '.quantity button', function () {
        let btn = $(this);
        let groupedProduct = btn.closest('.woocommerce-grouped-product-list-item__quantity').length;
        let inputQty = btn.parent().find('.qty');
        let prevValue = +(inputQty.val());
        let newValue = groupedProduct ? 0 : 1;
        if (btn.hasClass('btn-plus')) {
            newValue = prevValue + 1;
        } else {
            if (!groupedProduct && prevValue > 1) {
                newValue = prevValue - 1;
            } else if (groupedProduct && prevValue > 0) {
                newValue = prevValue - 1;
            }
        }
        inputQty.val(newValue);
        $('.update-cart').prop('disabled', false);
    });

    $('[data-fancybox="gallery"]').fancybox({
        buttons: [
            "zoom",
            "close"
        ],
        loop: true,
        protect: true,
    });

    $('form.variations_form').on('change', 'select', function() {
        // Получаем ID выбранного варианта
        var selectedVariationId = $(this).find(':selected').data('variation-id');

        // Находим соответствующее изображение
        $('#variation-images img[data-variation-id="' + selectedVariationId + '"]').each(function() {
            var newImageUrl = $(this).attr('src');
            $('#product-image').attr('src', newImageUrl);
            $('#main-product-image').attr('href', newImageUrl); // Обновляем ссылку для лайтбокса
        });
    });
    
});


//Одинаковая высота для каждой карточки в карусели
function setEqualHeight() {
    var maxHeight = 0;
    $('.owl-carousel .product-card-item').css('height', 'auto');
    
    $('.owl-carousel .product-card-item').each(function(){
        var thisHeight = $(this).outerHeight();
        if (thisHeight > maxHeight) {
            maxHeight = thisHeight;
        }
    });
    
    $('.owl-carousel .product-card-item').css('height', maxHeight + 'px');
}

$(window).on('load', setEqualHeight);
$('.owl-carousel').on('initialized.owl.carousel', setEqualHeight);
$(window).resize(setEqualHeight);








