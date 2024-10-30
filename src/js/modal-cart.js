document.addEventListener('DOMContentLoaded', function() {
    const buttonCard = document.querySelector('.ajax_add_to_cart');
    const modalCart = document.querySelector('.custom-modal-cart');
    const close = document.querySelector('.custom-modal-cart__modal .close');
    const continueShopping = document.querySelector('.custom-modal-cart__btn-continue-shopping');
    const loader = document.querySelector('.custom-ajax-loader');
    
    buttonCard.addEventListener('click', function() {
        modalCart.classList.add('active');
        document.body.classList.add('no-scroll');

        //loader modal
        loader.style.display = 'block';

        setTimeout(() => {
            loader.style.display = 'none    ';
        }, 2000);
    });

    close.addEventListener('click', function() {
        modalCart.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });

    continueShopping.addEventListener('click', function() {
        modalCart.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });

});