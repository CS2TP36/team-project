function search() {
    // get the content of the search bar
    console.log(document.getElementById('search-bar').value);
    let searchTerm = document.getElementById('search-bar').value;
    // convert space to #
    searchTerm = searchTerm.replace(' ', '%20');
    searchTerm = searchTerm.replace('\\', '');
    // runs the search in a new window
    const url = `/search/${searchTerm}`;
    if (searchTerm !== '') {
        window.location.href = url;
    }
}

// search preview stuff
document.addEventListener("DOMContentLoaded", function () {//This waits for the page to be loaded before any of the javascript loadsup//
    const previewSearch = document.getElementById("search-bar");//This get the element of the search bar, and stores it in the variable preview search//
    const previews = document.getElementById("previews-container");//Another variable that is created by getting the id element from the previews-container
    //Start of the event statement to check for inputs//
    previewSearch.addEventListener("input", function () {//This logs and stores the inputs of the search bar data as a function//
        if (previewSearch.value === '') {//This is checking if the search placeholder has any values inside of it//
            previews.innerHTML = '';//This makes the previews container be empty if the search bar contains nothing inside of it//
            return; //Just returns the previews container being empty//
        }
        fetch(`/search-preview/${(previewSearch.value)}`)//using the PHP search controller a https get request is sent to get the products that are related to the searched letters//
            .then(fetchedinfo => fetchedinfo.json()).then(fetchedproduct => {//turns the data its fetched into json format and then into data so it can be later used and processed//
            previews.innerHTML = '';//if the fetched information is not in the database, then it then clears the tag//
            fetchedproduct.forEach(x => {//for each objects in the fetchedproducts array it iterates through the array//
                //creates a varaible to create a link element in the html page//
                const productpreviewid = x.id//creates a variable for the id of the products//
                const productpreviewname = x.name//create a variable for the name of the products//
                const previewsA = document.createElement("a");//creates the html link//
                previewsA.classList.add('preview-link'); //gives the html link a class called preview-link//
                previewsA.href = `/product/${productpreviewid}`; //it sets the reference of the products to the id that was collected //
                previewsA.textContent = productpreviewname; //add the text of the preview to be the name of the product//
                previews.appendChild(previewsA);//adds the link to the previews division//
                previews.appendChild(document.createElement("br"));//adds the text break for spacing//
            });
        })

    });
});
