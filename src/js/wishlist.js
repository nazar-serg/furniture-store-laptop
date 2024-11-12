// jQuery(document).ready(function($) {

//     $('.withlist-icon').on('click', function() {
//         let $this = $(this);
//         let productId = $this.data('id');
//         let ajaxLoader = $this.closest('.product-card-item').find('.ajax-loader');
//         console.log(productId);

//         $.ajax({
//             url: furniturestore_wishlist_object.url,
//             type: 'POST',
//             data: {
//                 action: 'furniturestore_wishlist_action',
//                 nonce: furniturestore_wishlist_object.nonce,
//                 product_id: productId,
//             },

//             beforeSend: function() {
//                 ajaxLoader.fadeIn();
//             },
//             success: function(res) {
//                 console.log(res);
//                 ajaxLoader.fadeOut();
//             },
//             error: function() {
//                 ajaxLoader.fadeOut();
//                 alert('Помилка при додаванні обраного товару');
//             }
//         });
//     });
 
// });

jQuery(document).ready(function ($) {
    $(".add-to-wishlist").on("click", function () {
        const button = $(this);
        const productId = button.data("product-id");
        const nonce = wishlist_params.nonce; 
        const messageElement = button.prev();
        const icon = button.find(".fa-heart");
        
        const isAdded = icon.hasClass("wishlist-added");

        $.ajax({
            url: wishlist_params.ajax_url,
            method: "POST",
            data: {
                action: isAdded ? "remove_from_wishlist" : "add_to_wishlist",
                product_id: productId,
                nonce: nonce
            },
            success: function (data) {
                if (data.success) {
                    if (isAdded) {
                       
                        messageElement.text("Product removed from wishlist.");
                        messageElement.css("color", "red");
                        icon.removeClass("wishlist-added");
                    } else {
                        
                        messageElement.text("Product added to wishlist!");
                        messageElement.css("color", "green");
                        icon.addClass("wishlist-added");
                    }
                } else {
                    messageElement.text("Failed to update wishlist.");
                    messageElement.css("color", "red");
                }
                messageElement.show();

                setTimeout(function () {
                    messageElement.fadeOut(); 
                }, 5000);
            },
            error: function () {
                messageElement.text("Failed to update wishlist.");
                messageElement.css("color", "red");
                icon.removeClass("wishlist-added");
                messageElement.show();

                setTimeout(function () {
                    messageElement.fadeOut();
                }, 5000);
            }
        });
    });
});


