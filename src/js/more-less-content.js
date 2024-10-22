document.addEventListener("DOMContentLoaded", function() {
	const content = document.querySelector('.home-text__wrapper');
	const showMoreBtn  = document.querySelector('.show-more-btn');
	const showLessBtn  = document.querySelector('.show-less-btn');

	showMoreBtn.addEventListener('click', function() {
		content.classList.add('home-text__wrapper--lgn');
		content.style.maxHeight = 'none';
		content.style.overflow = 'visible';
		showMoreBtn.style.display = 'none';
		showLessBtn.style.display = 'inline-block';
	});

	showLessBtn.addEventListener('click', function() {
		content.classList.remove('home-text__wrapper--lgn');
		content.style.maxHeight = '350px';
		content.style.overflow = 'hidden';
		showLessBtn.style.display = 'none';
		showMoreBtn.style.display = 'inline-block';
	});
});