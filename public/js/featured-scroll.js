document.addEventListener("DOMContentLoaded", () => {
    let scrollContainer = document.querySelector(".featured-item-container");
    let backBtn = document.querySelector(".back-button");  
    let nextBtn = document.querySelector(".next-button");  



    nextBtn.addEventListener("click", () => {
        scrollContainer.scrollLeft += 1700;
    });

    backBtn.addEventListener("click", () => {
        scrollContainer.scrollLeft -= 1700; 
    });
});
