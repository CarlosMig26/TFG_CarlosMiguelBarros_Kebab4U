document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star-rating .fa-star');
    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            document.getElementById('rating').value = rating;
            stars.forEach(s => s.classList.remove('checked'));
            for (let i = 0; i < rating; i++) {
                stars[i].classList.add('checked');
            }
        });
    });
});
