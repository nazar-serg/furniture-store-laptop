document.addEventListener("DOMContentLoaded", function() {

    const productContainer = document.querySelector('.products-row');
    const productCards = document.querySelectorAll('.product-card-item');
    let visibleCount = 6;
    const increment = 3;

    const loadMoreBtn = document.createElement('button');
    loadMoreBtn.textContent = "Завантажте більше продуктів";
    loadMoreBtn.classList.add('button');
    loadMoreBtn.classList.add('load-more-btn');
    loadMoreBtn.id = "load-more-btn";

    productContainer.parentNode.appendChild(loadMoreBtn);

    function showMoreProducts() {
        let count = 0;

        for (let i = visibleCount; i < productCards.length && count < increment; i++) {
            productCards[i].style.display = 'flex';
            count++;
        }

        visibleCount += count;

        if (visibleCount >= productCards.length) {
            loadMoreBtn.style.display = 'none';
        }
    }

    loadMoreBtn.addEventListener('click', showMoreProducts);

    if (visibleCount >= productCards.length) {
        loadMoreBtn.style.display = 'none';
    }
});