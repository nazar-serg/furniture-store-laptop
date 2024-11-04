document.addEventListener("DOMContentLoaded", function() {
    const headers = document.querySelectorAll('.faq__header');

    headers.forEach(header => {
        
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            this.classList.toggle('active');

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });
});