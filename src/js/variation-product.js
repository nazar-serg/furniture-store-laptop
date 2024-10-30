document.addEventListener('DOMContentLoaded', function () {
    const colorOptions = document.querySelectorAll('.color-option');
    const colorSelect = document.querySelector('form.variations_form');
    const productImage = document.querySelector('.woocommerce-product-gallery__image img');
    const addToCartButton = document.querySelector('.wc-variation-selection-needed');

    colorOptions.forEach(option => {
        option.addEventListener('click', function () {
            
            colorOptions.forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');

            const variationId = this.getAttribute('data-variation-id');
            const imageUrl = this.getAttribute('data-image');

            colorSelect.querySelector('input[name="variation_id"]').value = variationId;

            if (productImage && imageUrl) {
                productImage.src = imageUrl;
                productImage.srcset = imageUrl;
            }
        });
    });

    addToCartButton.addEventListener('click', function(event) {
        this.classList.remove('disabled');
        const activeColorOption = document.querySelector(".color-option.active");
        if (!activeColorOption) {
            event.preventDefault();
            alert("Будь ласка, оберіть колір товару перед додаванням до кошика.");
        }
    });
});

