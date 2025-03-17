//function for displaying the star rating for each review
function displayStarRating(rating, starId) {
    const starContainer = document.getElementById(starId);
    starContainer.innerHTML = '';

    for (let i = 1; i <= 5; i++) {
        const star = document.createElement('span');
        if (i <= rating) {
            star.textContent = '⭐';
        } else {
            star.textContent = '';
        }
        starContainer.appendChild(star);
    }
}
