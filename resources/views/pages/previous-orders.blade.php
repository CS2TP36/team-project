@extends("layouts.page")
@php($noFooter = true)
@use(App\Http\Controllers\PreviousOrdersController)
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Shipping)

@section("title", "Previous Orders")
@section("content")
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
    // Script for "Load more" functionality
    document.addEventListener('DOMContentLoaded', function () {
        const loadMoreBtn = document.getElementById('load-more');
        if (!loadMoreBtn) return; // If there's no button, do nothing

        loadMoreBtn.addEventListener('click', function () {
            // Determine current page from data-page or default to page 2
            let pageNo = parseInt(this.getAttribute('data-page')) || 2;

            // Fetch next set of orders via AJAX
            fetch(`/orders/more?page=${pageNo}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                // Append the newly loaded orders to the existing list
                document.getElementById('orders-list').insertAdjacentHTML('beforeend', html);
                // Increment page number for next time
                this.setAttribute('data-page', pageNo + 1);
            })
            .catch(error => console.error('Error loading more orders:', error));
        });
    });
</script>