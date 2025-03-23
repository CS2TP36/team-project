<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ManageUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowRedirectsIfNotAdmin()
    {
        $user = User::factory()->create(['role' => 'customer']);
        Auth::login($user);

        $controller = new ManageUsersController;
        $request = Request::create('/admin/manage-users', 'GET');
        $response = $controller->show($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testShowReturnsViewIfAdmin()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Auth::login($user);

        $controller = new ManageUsersController;
        $request = Request::create('/admin/manage-users', 'GET');
        $response = $controller->show($request);

        $this->assertInstanceOf(View::class, $response);
    }
}