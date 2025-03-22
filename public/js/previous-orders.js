// the script for loading more pages of orders (need to do it on page as it will use some blade variables)
// first wait for the page to load
document.addEventListener('DOMContentLoaded', function () {
    // // fix chromium header issue
    // var isChromium = !!window.chrome;
    // if (isChromium) {
    //     document.getElementsByTagName('header')[0].style.marginTop = '110px';
    // }

    // get the load more button
    const loadMoreBtn = document.getElementById('load-more');
    if (!loadMoreBtn) return; // If there's no button, do nothing
    // add an event listener to the button
    loadMoreBtn.addEventListener('click', function () {
        // get the current page number using parseInt to convert it to a number
        let pageNo = parseInt(this.getAttribute('data-page')) || 2;

        // make a fetch request to server to get next set of orders
        fetch(`/orders/more?page=${pageNo}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            // put hte response into the page
            .then(response => response.text())
            .then(html => {
                // Append the newly loaded orders to the existing orders list
                document.getElementById('orders-list').insertAdjacentHTML('beforeend', html);
                // Increment page number
                this.setAttribute('data-page', pageNo + 1);
            })
            // catch errors
            .catch(error => console.error('Error loading more orders:', error));
    });
});
