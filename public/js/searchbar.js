function search() {
    // get the content of the search bar
    console.log(document.getElementById('search-bar').value);
    let searchTerm = document.getElementById('search-bar').value;
    // convert space to #
    searchTerm = searchTerm.replace(' ', '#');
    searchTerm = searchTerm.replace('\\', '');
    // runs the search in a new window
    const url = `/search/${searchTerm}`;
    if (searchTerm !== '') {
        window.open(url);
    }
}
