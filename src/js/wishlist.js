import iziToast from 'izitoast';

jQuery(document).ready(function($) {

    $('.custom-wishlist-icon').on('click', function() {
        let $this = $(this);

        if ($this.hasClass('lock')) {
            iziToast.warning({
                title: 'Warning',
                message: furniturestore_wishlist_object.warning_1,
                position: 'topRight'
            });

            return false;
        }

        $('.custom-wishlist-icon').addClass('lock');
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card-item').find('.ajax-loader');
        let ajaxLoaderReviewed = $this.closest('.product-card-item-reviewed').find('.ajax-loader');

        $.ajax({
            url: furniturestore_wishlist_object.url,
            type: 'POST',
            data: {
                action: 'furniturestore_wishlist_action',
                nonce: furniturestore_wishlist_object.nonce,
                product_id: productId
            },

            beforeSend: function() {
                ajaxLoader.fadeIn();
                ajaxLoaderReviewed.fadeIn();
            },

            success: function(res) {
                $('.custom-wishlist-icon').removeClass('lock');
                res = JSON.parse(res);
                if (res.status === 'success') {
                    $this.toggleClass('in-wishlist');
                    iziToast.success({
                        title: res.status,
                        message: res.answer,
                        position: 'topRight',
                        backgroundColor: 'green',
                        messageColor: 'white',
                        color: 'white'
                    });
                } else {
                    iziToast.error({
                        title: res.status,
                        message: res.answer,
                        position: 'topRight'
                    });
                }

                if (location.pathname === '/featurestore/wishlist/' || location.pathname === '/wishlist/') {
                    iziToast.warning({
                        message: furniturestore_wishlist_object.warning_2,
                        position: 'topRight',
                        timeout: 2000,
                        onClosing: function(instance, toast, closedBy){
                            location = location.href;
                        }
                    });
                }

                ajaxLoader.fadeOut();
                ajaxLoaderReviewed.fadeOut();
            },

            error: function() {
                $('.custom-wishlist-icon').removeClass('lock');
                ajaxLoader.fadeOut();
                ajaxLoaderReviewed.fadeOut();
                iziToast.error({
                    title: 'Error',
                    message: 'Error add to wishlist',
                    position: 'topRight'
                });
            },
        });
    });
});
