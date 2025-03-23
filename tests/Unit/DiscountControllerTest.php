<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Admin\DiscountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DiscountCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DiscountControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowRedirectsIfNotAdmin()
    {
        $user = User::factory()->create(['role' => 'customer']);
        Auth::login($user);

        $controller = new DiscountController;
        $request = Request::create('/admin/discounts', 'GET');
        $response = $controller->show($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testShowReturnsViewIfAdmin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Auth::login($user);

        $controller = new DiscountController;
        $request = Request::create('/admin/discounts', 'GET');
        $response = $controller->show($request);

        $this->assertInstanceOf(View::class, $response);
    }

    public function testAddRedirectsIfNotAdmin()
    {
        $user = User::factory()->create(['role' => 'customer']);
        Auth::login($user);

        $controller = new DiscountController;
        $request = Request::create('/admin/discounts', 'POST', [
            'start'       => '2025-01-01',
            'expiry'      => '2025-12-31',
            'code'        => 'TESTCODE',
            'percent_off' => 20
        ]);

        $response = $controller->add($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseMissing('discount_codes', [
            'code' => 'TESTCODE'
        ]);
    }

    public function testAddCreatesDiscountForAdmin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Auth::login($user);

        $controller = new DiscountController;
        $request = Request::create('/admin/discounts', 'POST', [
            'start'       => '2025-01-01',
            'expiry'      => '2025-12-31',
            'code'        => 'TESTCODE',
            'percent_off' => 25,
        ]);

        $response = $controller->add($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('discount_codes', [
            'code'        => 'TESTCODE',
            'percent_off' => 25,
        ]);
    }
}