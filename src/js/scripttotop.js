jQuery(document).ready(function($) {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });

    $('#top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 500);
        return false;
    });
});