@extends("layouts.page")
@use(App\Http\Controllers\PreviousOrders)
@use(Illuminate\Support\Facades\Auth)
@use(App\Models\Shipping)
@section("title", "Previous Orders")
@section("content")
    @php($orders = PreviousOrders::getPreviousOrders(Auth::user()))

    <!-- main container -->
    <div id="previous-orders">
        <h1>My Previous Orders</h1>
        @if($orders->count() > 0)

            <!-- Order list section -->
            <div class="orders-list">
                @include('reusables.previous-orders')
            </div>
        @else
            <p>No previous orders found</p>
        @endif
    </div>
@endsection
