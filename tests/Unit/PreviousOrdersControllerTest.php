<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\PreviousOrdersController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PreviousOrdersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowRedirectsIfNotLoggedIn()
    {
        Auth::logout();
        $request = Request::create('/orders', 'GET');
        $controller = new PreviousOrdersController;
        $response = $controller->show($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testShowWorksIfLoggedIn()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $request = Request::create('/orders', 'GET');
        $controller = new PreviousOrdersController;
        $response = $controller->show($request);

        $this->assertInstanceOf(View::class, $response);
    }
}