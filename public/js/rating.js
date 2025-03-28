// Code runs after the HTML doc is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    const ratingContainer = document.querySelector('.rating');
    const stars = ratingContainer.querySelectorAll('.star');
    const ratingHolder = document.querySelector('#rating-holder');
    // Iterates through each star elements in "stars"
    stars.forEach(star => {
        // Adds a click event listener to each star
        star.addEventListener('click', () => {
            // Gets the star's rating value (1, 2, 3, 4 or 5)
            // Example: Clicking on the third star results in the star rating value "3" being stored in "rating"
            const rating = parseInt(star.dataset.value, 10);
            ratingContainer.dataset.rating = rating;

            // Update star appearance
            // Each stars value is compared to "rating", from previous example this would have the value "3"
            // Sets all the stars up to and including the "rating" value as active, in the example this would be 3 stars
            // It sets the other stars as inactive (Star 4 and Star 5)
            stars.forEach(s => {
                if (s.dataset.value <= rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
            });

            // Update the rating holder
            ratingHolder.value = rating;
        });
    });
});

function validate() {
    let messageArea = document.getElementsByClassName("message-area")[0];
    // check if rating been left
    var rating = document.getElementById('rating-holder').value;
    if (rating === "" || rating === null || rating < 1){
        messageArea.innerHTML += "<div id=\"message-error\" class=\"error\">\n" +
            "                <img src=\"/images/caution-icon.png\"></img>\n" +
            "                Please rate the product (1-5 stars)\n" +
            "            </div>";
        return false;
    }
    //check if headline been left
    var headline = document.getElementById('headline').value;
    if (headline === "" || headline === null){
        messageArea.innerHTML += "<div id=\"message-error\" class=\"error\">\n" +
            "                <img src=\"/images/caution-icon.png\"></img>\n" +
            "                Please add a headline\n" +
            "            </div>";
        return false;
    }
    //check if review been left
    var review = document.getElementById('message').value;
    if (review === "" || review === null){
        messageArea.innerHTML += "<div id=\"message-error\" class=\"error\">\n" +
            "                <img src=\"/images/caution-icon.png\"></img>\n" +
            "                Please add a message\n" +
            "            </div>";
        return false;
    }
    document.getElementById("review-form").submit();
}
