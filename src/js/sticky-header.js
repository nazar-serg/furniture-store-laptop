document.addEventListener("DOMContentLoaded", function() {

    const header = document.querySelector('.header');
    //let lastScrollTop = 0;

    function onScroll() {
        let currentScroll = window.scrollY;

        if (currentScroll > 100) {
            header.classList.add('fixed-header');
        } else {
            header.classList.remove('fixed-header');
        }

        //lastScrollTop  = currentScroll <= 0 ? 0 : currentScroll;
    }

    window.addEventListener('scroll', onScroll);
});