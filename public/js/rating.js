document.addEventListener('DOMContentLoaded', () => {
    const ratingContainer = document.querySelector('.rating');
    const stars = ratingContainer.querySelectorAll('.star');
    const ratingHolder = document.querySelector('#rating-holder');
    stars.forEach(star => {
        star.addEventListener('click', () => {
            const rating = parseInt(star.dataset.value, 10);
            ratingContainer.dataset.rating = rating;

            // Update star appearance
            stars.forEach(s => {
                if (s.dataset.value <= rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });

            // You can now submit the rating to your server or perform other actions
            console.log("Rating submitted:", rating);

            // Update the rating holder
            ratingHolder.value = rating;
        });
    });
});
