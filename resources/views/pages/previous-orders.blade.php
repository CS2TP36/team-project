@extends("layouts.page")
@use(App\Http\Controllers\PreviousOrders)
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Shipping)
@section("title", "Previous Orders")
@section("content")
    <!-- main container -->
    <div id="previous-orders">
        <h1>My Previous Orders</h1>
        @if($orders->count() > 0)

            <!-- Order list section -->
            <div class="orders-list">
                @include('reusables.previous-orders')
            </div>
            @if ($orders->hasMorePages())
                <button id="load-more">Load more pages</button>
            @endif
        @else
            <p>No previous orders found</p>
        @endif
    </div>
@endsection
