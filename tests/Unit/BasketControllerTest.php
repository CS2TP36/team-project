<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\BasketController;
use App\Models\User;
use App\Models\Product;
use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class BasketControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexRedirectsIfLoggedOut()
    {
        Auth::logout();
        $controller = new BasketController;
        $response = $controller->index();

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testIndexShowsBasketAndTotalIfLoggedIn()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product = Product::factory()->create(['price' => 10.0]);
        Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 3,
            'size'       => 'M',
        ]);

        $controller = new BasketController;
        $response   = $controller->index();

        $this->assertInstanceOf(View::class, $response);
        $data = $response->getData();
        $this->assertCount(1, $data['basketItems']);
        $this->assertEquals(30.0, $data['total']); // 3 items * 10.0 each
    }

    public function testAddCreatesBasketItemIfLoggedIn()
    {
        Session::start();

        $user = User::factory()->create();
        Auth::login($user);

        $product    = Product::factory()->create();
        $controller = new BasketController;

        $request = Request::create('/basket/add', 'POST', [
            'product_id' => $product->id,
            'quantity'   => 2,
            'size'       => 'M',
        ]);

        $request->setLaravelSession(app('session.store'));

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->add($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertDatabaseHas('baskets', [
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 2,
            'size'       => 'M',
        ]);
    }

    public function testUpdateItemQuantity()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $product    = Product::factory()->create();
        $basketItem = Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 1,
            'size'       => 'M',
        ]);

        $controller = new BasketController;
        $request = Request::create("/basket/update/{$basketItem->id}", 'PATCH', [
            'quantity' => 5
        ]);

        $request->setLaravelSession(app('session.store'));

        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->update($request, $basketItem->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(5, $basketItem->fresh()->quantity);
    }

    public function testRemoveItem()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $basketItem = Basket::factory()->create([
            'user_id' => $user->id,
        ]);

        $controller = new BasketController;
        $response   = $controller->remove($basketItem->id);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertDatabaseMissing('baskets', [
            'id' => $basketItem->id,
        ]);
    }

    public function testRemoveOutOfStock()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $inStock    = Product::factory()->create(['stock' => 5]);
        $outOfStock = Product::factory()->create(['stock' => 0]);

        $basket1 = Basket::create([
            'user_id'    => $user->id,
            'product_id' => $inStock->id,
            'quantity'   => 1,
            'size'       => 'M',
        ]);
        $basket2 = Basket::create([
            'user_id'    => $user->id,
            'product_id' => $outOfStock->id,
            'quantity'   => 2,
            'size'       => 'S',
        ]);

        $controller = new BasketController;
        $request    = Request::create('/basket/remove-out-of-stock', 'POST');

        $request->setLaravelSession(app('session.store'));
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        $response = $controller->removeOutOfStock($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertDatabaseHas('baskets', ['id' => $basket1->id]);
        $this->assertDatabaseMissing('baskets', ['id' => $basket2->id]);
    }
}