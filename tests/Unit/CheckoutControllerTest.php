<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\CheckoutController;
use App\Models\User;
use App\Models\Product;
use App\Models\Basket;
use App\Models\Address;
use App\Models\PaymentMethod;
use App\Models\DiscountCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 
     * 
     * 
     */

    public function testCheckoutWithNewAddressAndNewPaymentMethod()
    {
        Session::start();
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create([
            'price' => 20.0,
            'stock' => 5,
        ]);

        Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 2,
            'size'       => 'M',
        ]);

        $request = Request::create('/checkout', 'POST', [
            'shipping_address'       => 'new',
            'shipping_full_name'     => 'New Shipping Name',
            'shipping_address_line1' => '123 Random St',
            'shipping_city'          => 'New City',
            'shipping_post_code'     => '12345',
            'shipping_phone'         => '07123456789',
            'save_new_address'       => '1',

            'payment_method'       => 'new',
            'payment_card_name'    => 'John Tester',
            'payment_card_number'  => '4111111111111111',
            'payment_expiry'       => '03/25',
            'payment_cvv'          => '123',
            'save_new_payment'     => '1',

            'shipping_option' => 'next_day', 
            
        ]);

        $controller = new CheckoutController;
        $response   = $controller->checkout($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('pages.success', $response->name());

        $this->assertDatabaseHas('addresses', [
            'user_id'       => $user->id,
            'full_name'     => 'New Shipping Name',
            'address_line1' => '123 Random St',
        ]);

        $this->assertDatabaseHas('payment_methods', [
            'user_id'     => $user->id,
            'card_name'   => 'John Tester',
            'card_number' => '4111111111111111',
        ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'order_total_price' => 46.49,
        ]);

        $this->assertDatabaseHas('products', [
            'id'    => $product->id,
            'stock' => 3,
        ]);

        $this->assertDatabaseMissing('baskets', [
            'user_id' => $user->id,
        ]);
    }

    public function testCheckoutWithExistingAddressAndPaymentMethod()
    {
        Session::start();
        $user = User::factory()->create();
        Auth::login($user);

        $address = Address::factory()->create([
            'user_id'       => $user->id,
            'full_name'     => 'Existing Ship Name',
            'address_line1' => 'Existing St',
        ]);

        $payment = PaymentMethod::factory()->create([
            'user_id'      => $user->id,
            'card_name'    => 'Existing Card',
            'card_number'  => '5555666677778888',
            'expiry_month' => '12',
            'expiry_year'  => '24',
            'cvv'          => '999',
        ]);

        $product = Product::factory()->create([
            'price' => 15.0,
            'stock' => 10,
        ]);
        Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'size'       => 'L',
        ]);

        $request = Request::create('/checkout', 'POST', [
            'shipping_address' => $address->id, 
            'payment_method'   => $payment->id, 
            'shipping_option'  => 'standard',  
        ]);

        $controller = new CheckoutController;
        $response   = $controller->checkout($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('pages.success', $response->name());

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'order_total_price' => 19.49,
        ]);
        $this->assertDatabaseMissing('baskets', [
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('products', [
            'id'    => $product->id,
            'stock' => 9,
        ]);
    }

    public function testCheckoutWithDiscountCode()
    {
        Session::start();
        $user = User::factory()->create();
        Auth::login($user);

        $discount = DiscountCode::factory()->create([
            'code'        => 'TEST20',
            'percent_off' => 20,
        ]);

        $product = Product::factory()->create([
            'price' => 50.0,
            'stock' => 2,
        ]);
        Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'size'       => 'M',
        ]);

        $address = Address::factory()->create(['user_id' => $user->id]);
        $payment = PaymentMethod::factory()->create(['user_id' => $user->id]);

        $request = Request::create('/checkout', 'POST', [
            'shipping_address' => $address->id,
            'payment_method'   => $payment->id,
            'shipping_option'  => 'standard', // 4.49
            'apply_discount'   => '1',
            'discount_code'    => 'TEST20',
        ]);

        $controller = new CheckoutController;
        $response   = $controller->checkout($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('pages.success', $response->name());

        $this->assertDatabaseHas('orders', [
            'user_id'          => $user->id,
            'order_total_price' => 43.592,
        ]);
        $this->assertDatabaseMissing('baskets', [
            'user_id' => $user->id,
        ]);
    }

    public function testCheckoutOutOfStockItem()
    {
        Session::start();
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create([
            'stock' => 0,
        ]);
        Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'size'       => 'M',
        ]);

        $address = Address::factory()->create(['user_id' => $user->id]);
        $payment = PaymentMethod::factory()->create(['user_id' => $user->id]);

        $request = Request::create('/checkout', 'POST', [
            'shipping_address' => $address->id,
            'payment_method'   => $payment->id,
            'shipping_option'  => 'standard',
        ]);

        $controller = new CheckoutController;
        $response   = $controller->checkout($request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('pages.checkout_out_of_stock', $response->name());
        $this->assertDatabaseCount('orders', 0);
    }
}