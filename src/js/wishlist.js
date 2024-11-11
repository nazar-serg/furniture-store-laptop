jQuery(document).ready(function($) {

    $('.withlist-icon').on('click', function() {
        let $this = $(this);
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card-item').find('.ajax-loader');
        console.log(productId);

        $.ajax({
            url: furniturestore_wishlist_object.url,
            type: 'POST',
            data: {
                action: 'furniturestore_wishlist_action',
                nonce: furniturestore_wishlist_object.nonce,
                product_id: productId,
            },

            beforeSend: function() {
                ajaxLoader.fadeIn();
            },
            success: function(res) {
                console.log(res);
                ajaxLoader.fadeOut();
            },
            error: function() {
                ajaxLoader.fadeOut();
                alert('Помилка при додаванні обраного товару');
            }
        });
    });
 
});