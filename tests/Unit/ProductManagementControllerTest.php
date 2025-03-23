<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Admin\ProductManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductManagementControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexRedirectsIfNotAdmin()
    {
        $user = User::factory()->create(['role' => 'customer']);
        Auth::login($user);

        $controller = new ProductManagementController;
        $request = Request::create('/admin/products', 'GET');
        $response = $controller->index($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testIndexReturnsViewIfAdmin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Auth::login($user);

        $controller = new ProductManagementController;
        $request = Request::create('/admin/products', 'GET');
        $response = $controller->index($request);

        $this->assertInstanceOf(View::class, $response);
    }
}