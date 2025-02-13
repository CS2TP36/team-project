@extends("layouts.page")
@use(App\Http\Controllers\PreviousOrders)
@use(Illuminate\Support\Facades\Auth)
@section("title", "Previous Orders")
@section("content")
    @php($orders = PreviousOrders::class->getPreviousOrders(Auth::getUser()))
    
    <!-- main container -->
    <div id="previous-orders">
    <h1>My Previous Orders</h1>

<!--order list section -->
<div class= "orders-list">

<!-- order 1-->
 <div class = "order">
    <div class="order-info">
        
    <!--order details(date,price and dispatched date using dummy data for now) -->
    <p class="order-date">Order placed: 1st Jan 2025</p>
    <p class="dispatch-to">Dispatched to: 1 Aston Uni</p>
    <p class="order-price">Total: £20.00</p>
  </div>

  <div class="order-items">
 
  <!-- Order 1 details-->
    <img src="productImage/1aff6d07-c83f-4882-959a-b4fa2ed5a19a.jpg">
    <div class="item-details">
    <p class="item-name">Trail Runner Pro Shoes</p>
    <p class="item-price">£20.00</p>
    </div>
    </div>

    <div class="order-actions">
        <!-- buttons for order 1 -->
        <button class="button">Buy again</button>
        <button class="button">Order Details</button>
        <button class="button">Leave a review</button>
                </div>
            </div>

    <!-- Order 2-->
<div class="order">
    <div class="order-info">
        <p class="order-date">Order placed: 1st February 2025</p>
        <p class="dispatch-to">Dispatched to: 2 Aston Uni</p>
        <p class="order-price">Total: £55.00</p>
    </div>


    <div class="order-items">
        <div class="item">
            <!--item 1 of second order details-->
            <img src="productImage/8573ac4b-e2c8-4ea3-8909-f60126839a3c.jpg">
            <div class="item-details">
                <p class="item-name">Pulse Track Running Shoes</p>
                <p class="item-price">£20.00</p>
            </div>
        </div>

        <!-- item 2 of second order-->
        <div class="item">
            <img src="productImage\68313941-69f1-4bf9-bb02-de3a64caa29f.jpg">
            <div class="item-details">
                <p class="item-name">Velocity Running Shoes </p>
                <p class="item-price">£35.00</p>
            </div>
        </div>
    </div>

    <!-- buttons for order 2-->
    <div class="order-actions">
        <button class="button">Buy again</button>
        <button class="button">Order Details</button>
        <button class="button">Leave a review</button>
    </div>
</div>
            
        </div>
    </div>

@endsection
