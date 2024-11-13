// jQuery(document).ready(function ($) {
//     // Получаем текущий список из localStorage
//     const wishlist = JSON.parse(localStorage.getItem("wishlist")) || [];

//     // Обработка клика по кнопке добавления в избранное
//     $(".add-to-wishlist").each(function () {
//         const button = $(this);
//         const productId = button.data("product-id");

//         if (wishlist.includes(productId)) {
//             button.find(".fa-heart").addClass("wishlist-added");
//         }
//     });

//     $(".add-to-wishlist").on("click", function () {
//         const button = $(this);
//         const productId = button.data("product-id");
//         const nonce = wishlist_params.nonce;
//         const messageElement = button.prev();  // Элемент для сообщений
//         const icon = button.find(".fa-heart");
//         const loader = button.closest(".product-loader").find(".ajax-loader");

//         loader.show();
        
//         const isAdded = icon.hasClass("wishlist-added");

//         $.ajax({
//             url: wishlist_params.ajax_url,
//             method: "POST",
//             data: {
//                 action: isAdded ? "remove_from_wishlist" : "add_to_wishlist",
//                 product_id: productId,
//                 nonce: nonce
//             },
//             success: function (data) {
//                 if (data.success) {
//                     if (isAdded) {
//                         messageElement.text("Видалено зі списку бажань.");
//                         messageElement.css("color", "red");
//                         icon.removeClass("wishlist-added");

//                         // Удаляем товар из localStorage
//                         const index = wishlist.indexOf(productId);
//                         if (index > -1) wishlist.splice(index, 1);
//                         localStorage.setItem("wishlist", JSON.stringify(wishlist));
//                     } else {
//                         messageElement.text("Додано до списку бажань!");
//                         messageElement.css("color", "green");
//                         icon.addClass("wishlist-added");

//                         // Добавляем товар в localStorage
//                         wishlist.push(productId);
//                         localStorage.setItem("wishlist", JSON.stringify(wishlist));
//                     }
//                 } else {
//                     messageElement.text("Не вдалося оновити список бажань.");
//                     messageElement.css("color", "red");
//                 }
//                 messageElement.show();

//                 setTimeout(function () {
//                     messageElement.fadeOut(); 
//                 }, 5000);
//             },
//             error: function () {
//                 messageElement.text("Не вдалося оновити список бажань.");
//                 messageElement.css("color", "red");
//                 icon.removeClass("wishlist-added");
//                 messageElement.show();

//                 setTimeout(function () {
//                     messageElement.fadeOut();
//                 }, 3000);
//             },
//             complete: function () {
//                 loader.hide();
//             }
//         });
//     });
// });

jQuery(document).ready(function($) {

    $('.custom-wishlist-icon').on('click', function() {
        let $this = $(this);
        let productId = $this.data('id');
        let ajaxLoader = $this.closest('.product-card-item').find('.ajax-loader');

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
            },

            success: function(res) {
                console.log(res);
                ajaxLoader.fadeOut();
            },

            error: function() {
                ajaxLoader.fadeOut();
                alert('Error add to wishlist');
            },
        });
    });
});
