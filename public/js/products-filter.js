

// trying to make options persistent in the form to show which filters are applied
document.addEventListener('DOMContentLoaded', function () {
    // get the breadcrumb list
    let breadcrumb = document.getElementById('breadcrumb-list');
    // get the path from the current url
    let path = (new URL(window.location)).pathname;
    // debug
    console.log(path);
    // split the path by /
    path = path.split("/");
    // remove first 2 elements
    path.shift();
    path.shift();
    //debug
    path.forEach(function (item) {
        console.log(item);
    })
    console.log(path);
    //get length
    let pathLen = path.length;
    // fill in filters for as long as list goes
    if (pathLen > 0) {
        if (path[0] === "1") {
            document.getElementById('mens').checked = true;
            breadcrumb.innerHTML += "<a href='/products/1'>Mens > </a>";
        } else if (path[0] === "0") {
            document.getElementById('womens').checked = true;
            breadcrumb.innerHTML += "<a href='/products/0'>Womens > </a>";
        }
        // sort by
        if (pathLen > 2) {
            if (path[1] === "price") {
                if (path[2] === "1") {
                    document.getElementById('low-to-high').checked = true;
                } else {
                    document.getElementById('high-to-low').checked = true;
                }
            } else if (path[1] === "name") {
                if (path[2] === "1") {
                    document.getElementById('alphabetical-a-to-z').checked = true;
                } else {
                    document.getElementById('alphabetical-z-to-a').checked = true;
                }
            } else if (path[1] === "popularity") {
                document.getElementById('popularity').checked = true;
            }
            // categories
            if (pathLen > 3) {
                switch (path[3]) {
                    case "4":
                        document.getElementById('coats').checked = true;
                        breadcrumb.innerHTML += "Coats";
                        break;
                    case "3":
                        document.getElementById('hoodies').checked = true;
                        breadcrumb.innerHTML += "Hoodies";
                        break;
                    case "2":
                        document.getElementById('trousers').checked = true;
                        breadcrumb.innerHTML += "Trousers";
                        break;
                    case "1":
                        document.getElementById('shoes').checked = true;
                        breadcrumb.innerHTML += "Shoes";
                        break;
                    case "5":
                        document.getElementById('shirts').checked = true;
                        breadcrumb.innerHTML += "Shirts";
                }
                // price filter
                if (pathLen > 4) {
                    switch (path[4]) {
                        case "1":
                            document.getElementById('price-0-25').checked = true;
                            break;
                        case "2":
                            document.getElementById('price-25-35').checked = true;
                            break;
                        case "3":
                            document.getElementById('price-35-45').checked = true;
                            break;
                        case "4":
                            document.getElementById('price-45+').checked = true;
                            break;
                    }
                }
            }
        }
    }
    // function for submission
    document.getElementById('productFilterForm').addEventListener('submit', function (event) {
        // stops it from doing something that breaks everything
        event.preventDefault();
        // get the elements for price sorting
        let priceHigh = document.getElementById('high-to-low');
        let priceLow = document.getElementById('low-to-high');
        let popularity = document.getElementById('popularity');
        // sorts by name as default
        let sortField = "name";

        // deals with the  gender selector
        const gender = document.querySelector('input[name="gender"]:checked');
        let genderVal = 2;
        if (gender) {
            genderVal = (gender.id === "mens" ? 1 : (gender.id === "womens" ? "0" : 2));
        }

        // deals with sorting
        const sortBy = document.querySelector('input[name="sort-by"]:checked');
        let filtDirection = "1";
        if (sortBy) {
            // check if they are sorting by price or name
            if (priceHigh.checked || priceLow.checked) {
                // changes to price if sorting by price
                sortField = "price";
                // sets direction for sorting
                filtDirection = (sortBy.id === 'high-to-low' ? "0" : 1);
            } else if (popularity.checked) {
                sortField = "popularity";
                // sets direction for sorting
                filtDirection = "0";
            } else {
                // sets direction for sorting
                filtDirection = (sortBy.id === 'alphabetical-a-to-z' ? 1 : "0");
            }

        }

        // sets the correct category
        let clothesCategoryValue = "0";
        const clothesCategory = document.querySelector('input[name="clothes-category"]:checked');
        if (clothesCategory) {
            switch (clothesCategory.id) {
                case 'coats':
                    clothesCategoryValue = 4;
                    break;
                case 'hoodies':
                    clothesCategoryValue = 3;
                    break;
                case 'trousers':
                    clothesCategoryValue = 2;
                    break;
                case 'shirts':
                    clothesCategoryValue = 5;
                    break;
                case 'shoes':
                    clothesCategoryValue = 1;
                    break;
            }
        }

        // deals with the price filter selectors
        let priceFilter = "0";
        const priceFilters = document.querySelector('input[name="price"]:checked');
        if (priceFilters) {
            switch (priceFilters.id) {
                case 'price-0-25':
                    priceFilter = 1;
                    break;
                case 'price-25-35':
                    priceFilter = 2;
                    break;
                case 'price-35-45':
                    priceFilter = 3;
                    break;
                case 'price-45+':
                    priceFilter = 4;
                    break;
            }
        }

        // generate the url
        const url = `/products/${genderVal || ''}/${sortField || ''}/${filtDirection || ''}/${clothesCategoryValue || ''}/${priceFilter}`;
        // swap current page for filtered url
        location.href = url;
    });
});

