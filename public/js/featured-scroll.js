document.addEventListener("DOMContentLoaded", () => {
    let scrollContainer = document.querySelector(".featured-item-container");
    let backBtn = document.querySelector(".back-button");  
    let nextBtn = document.querySelector(".next-button");  

    scrollContainer.addEventListener("wheel", (evt) => {
        evt.preventDefault();
        scrollContainer.scrollLeft += evt.deltaY;
    });

    nextBtn.addEventListener("click", () => {
        scrollContainer.scrollLeft += 900;
    });

    backBtn.addEventListener("click", () => {
        scrollContainer.scrollLeft -= 900; 
    });
});
