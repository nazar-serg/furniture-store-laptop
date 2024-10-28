document.addEventListener('DOMContentLoaded', function() {

    const searchButton = document.querySelector('.navbar__search');
    const searchContainer = document.querySelector('.navbar__search-full-container');
    const closeButton = document.querySelector('.navbar__search-full-container .close-btn');

    searchButton.addEventListener('click', function() {
        searchContainer.classList.add('active');
    });

    closeButton.addEventListener('click', function() {
        searchContainer.classList.remove('active');
    });

});