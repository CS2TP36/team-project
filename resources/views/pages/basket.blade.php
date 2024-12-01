@extends('layouts.page')
@section('title','Basket')
@section('content')
    <div class="basket">
        <h1>Basket</h1>
        <section>
            <h2>Your Basket</h2>
            <table>
                <thead>
                    <tr>
                        <th>Remove</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="#">Remove</a></td>
                        <td><img src="" alt="Athletic Pro Hoodie" width="50"></td>
                        <td>Athletic Pro Hoodie</td>
                        <td>£25.99</td>
                        <td><input type="number" value="1"></td>
                        <td>£25.99</td>
                    </tr>
                    <tr>
                        <td><a href="#">Remove</a></td>
                        <td><img src="" alt="Trailblazer Pullover Hoodie" width="50"></td>
                        <td>Trailblazer Pullover Hoodie</td>
                        <td>£30.00</td>
                        <td><input type="number" value="1"></td>
                        <td>£30.00</td>
                    </tr>
                    <tr>
                        <td><a href="#">Remove</a></td>
                        <td><img src="" alt="Apex Trainers" width="50"></td>
                        <td>Apex Trainers</td>
                        <td>£32.50</td>
                        <td><input type="number" value="1"></td>
                        <td>£32.50</td>
                    </tr>
                </tbody>
            </table>

            <div>
                <h3>Apply Coupon</h3>
                <input type="text" placeholder="Enter your coupon here ">
                <button>Apply</button>
            </div>

            <div>
                <h3> Basket Totals</h3>
                <p>Subtotal: £88.49</p>
                <p>Shipping: Free</p>
                <p><strong>Total: £88.49</strong></p>
                <button>Proceed to Checkout</button>
            </div>
        </section>
    </div>
@endsection
