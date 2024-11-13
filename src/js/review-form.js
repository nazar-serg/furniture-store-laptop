document.addEventListener('DOMContentLoaded', function() {

    const button = document.createElement('button');
    button.id = 'show-review-form';
    button.className = 'button';
    button.textContent = reviewStrings.leaveReview;

    const reviewsSection = document.getElementById('reviews');
    if (reviewsSection) {
        reviewsSection.append(button);
    }

    const reviewFormWrapper = document.getElementById('review_form_wrapper');
    if (reviewFormWrapper) {
        button.addEventListener('click', function() {
            reviewFormWrapper.classList.toggle('open');

            button.textContent = reviewFormWrapper.classList.contains('open') ? 
            reviewStrings.hideReview : 
            reviewStrings.leaveReview;
        });
    }
});
