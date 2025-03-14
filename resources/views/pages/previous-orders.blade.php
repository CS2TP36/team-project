@extends("layouts.page")
@php($noFooter = true)
@use(App\Http\Controllers\PreviousOrdersController)
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Shipping)
@section("title", "Previous Orders")
@section("content")
    <!-- main container -->
    <div id="previous-orders">
        <h1>My Previous Orders</h1>
        @if($orders->count() > 0)

            <!-- Order list section -->
            <div class="orders-list" id="orders-list">
                @include('reusables.previous-orders')
            </div>
            @if ($orders->hasMorePages())
                <button id="load-more">Load more orders</button>
            @endif
        @else
            <p>No previous orders found</p>
        @endif
    </div>
@endsection

<script>
    // the script for loading more pages of orders (need to do it on page as it will use some blade variables)
    // first wait for the page to load
    document.addEventListener('DOMContentLoaded', function () {
        // get the load more button
        const loadMore = document.getElementById('load-more');
        // add an event listener to the button
        loadMore.addEventListener('click', function () {
            // get the current page number using parseInt to convert it to a number
            let pageNo = parseInt(this.getAttribute('data-page')) || 2;
            // make a fetch request to the server to get the next set of orders
            fetch(`/orders/more?page=${pageNo}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
                // put hte response into the page
            }).then(response => response.text()).then(html => {
                // put received html inside the orders list after the current orders
                document.getElementById('orders-list').insertAdjacentHTML('beforeend', html);
                // increment the page number
                this.setAttribute('data-page', pageNo + 1);
                // catch errors
            }).catch(error => console.error(error));
        });
    });
</script>
