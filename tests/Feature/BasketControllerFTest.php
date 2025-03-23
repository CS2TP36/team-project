<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Product;
use App\Models\Basket;

class BasketControllerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function testBasketIndexRedirectsIfLoggedOut()
    {
        $response = $this->get('/basket');
        $response->assertRedirect('/login?redirect=basket');
        // or however your login route is set up
    }

    public function testBasketIndexShowsBasketIfLoggedIn()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create(['price' => 10.0]);
        Basket::create([
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 2,
            'size'       => 'M',
        ]);

        $response = $this->get('/basket');
        $response->assertStatus(200);
        $response->assertViewIs('pages.basket');
        $response->assertSee('£20.00'); // front-end check
    }

    public function testAddToBasket()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post('/basket/add', [
            'product_id' => $product->id,
            'quantity'   => 2,
            'size'       => 'M',
        ]);

        $response->assertRedirect('/basket');
        $this->assertDatabaseHas('baskets', [
            'user_id'    => $user->id,
            'product_id' => $product->id,
            'quantity'   => 2,
            'size'       => 'M',
        ]);
    }

    public function testUpdateBasketItem()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $basketItem = Basket::factory()->create([
            'user_id' => $user->id,
            'quantity' => 1,
        ]);

        $response = $this->patch("/basket/update/{$basketItem->id}", [
            'quantity' => 5
        ]);

        $response->assertRedirect('/basket');
        $this->assertDatabaseHas('baskets', [
            'id'       => $basketItem->id,
            'quantity' => 5,
        ]);
    }

    public function testRemoveBasketItem()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $basketItem = Basket::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/basket/remove/{$basketItem->id}");
        $response->assertRedirect('/basket');
        $this->assertDatabaseMissing('baskets', [
            'id' => $basketItem->id,
        ]);
    }

    public function testRemoveOutOfStockItems()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $inStock = Product::factory()->create(['stock' => 5]);
        $outOfStock = Product::factory()->create(['stock' => 0]);

        $basket1 = Basket::factory()->create([
            'user_id'    => $user->id,
            'product_id' => $inStock->id,
            'quantity'   => 1,
        ]);
        $basket2 = Basket::factory()->create([
            'user_id'    => $user->id,
            'product_id' => $outOfStock->id,
            'quantity'   => 5,
        ]);

        $response = $this->post('/basket/remove-out-of-stock');
        $response->assertRedirect('/basket');

        $this->assertDatabaseHas('baskets', [
            'id' => $basket1->id,
        ]);
        $this->assertDatabaseMissing('baskets', [
            'id' => $basket2->id,
        ]);
    }
}