document.addEventListener("DOMContentLoaded", () => {
    let scrollContainer = document.querySelector(".featured-item-container");
    let backBtn = document.querySelector(".back-button");  
    let nextBtn = document.querySelector(".next-button");  



    nextBtn.addEventListener("click", () => {
        scrollContainer.scrollLeft += 900;
    });

    backBtn.addEventListener("click", () => {
        scrollContainer.scrollLeft -= 900;
    });
});
document.addEventListener("DOMContentLoaded", function () { 
    const previewSearch = document.getElementById("search-bar");

    if (previewSearch) {
        previewSearch.addEventListener("input", function () {
            console.log("Search input:", previewSearch.value);

            fetch(`/search-preview/${encodeURIComponent(previewSearch.value.trim())}`)
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    console.log("Products:", data.name);
                })
                .catch(error => console.error("Error fetching search preview:", error));
        });
    }
});
