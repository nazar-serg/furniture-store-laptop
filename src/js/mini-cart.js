document.addEventListener('DOMContentLoaded', function () {
    const cartLink = document.querySelector('.navbar__cart-link');
    const miniCart = document.querySelector('.custom-mini-cart');
    const overlay = document.querySelector('.overlay');
    const content = document.querySelector('.wrapper');
    const closeBtn = document.querySelector('.custom-mini-cart .close-btn');

    cartLink.addEventListener('click', function(e) {
        e.preventDefault();
        miniCart.classList.add('active');
        overlay.classList.add('active');
        document.body.classList.add('no-scroll');
    });

    closeBtn.addEventListener('click', function() {
        miniCart.classList.remove('active');
        overlay.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });

    overlay.addEventListener('click', function() {
        miniCart.classList.remove('active');
        overlay.classList.remove('active');
        document.body.classList.remove('no-scroll');
    });

});