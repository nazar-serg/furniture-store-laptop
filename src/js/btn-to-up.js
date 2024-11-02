window.onscroll = function() {
    const scrollTopBtn = document.getElementById('scrollTopBtn');

    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollTopBtn.style.display = 'block';
    } else {
        scrollTopBtn.style.display = 'none';
    }

    scrollTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth',
        });
    });

};