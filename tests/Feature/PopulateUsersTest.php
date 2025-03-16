<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

class PopulateUsersTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    #[Test]
    public function creates_multiple_users_successfully()
    {
        // Manually clear users table to prevent duplicate email errors
        User::query()->delete();

        // Create 15 unique users
        User::factory()->count(15)->create([
            'email' => fn() => Str::uuid() . '@example.com', // Ensures true uniqueness
        ]);

        // Assert that 15 users were created
        $this->assertDatabaseCount('users', 15);

        // Fetch latest users and validate attributes
        $users = User::latest()->take(15)->get();
        $this->assertCount(15, $users);

        foreach ($users as $user) {
            $this->assertNotEmpty($user->email);
            $this->assertNotEmpty($user->first_name);
            $this->assertNotEmpty($user->last_name);
            $this->assertNotEmpty($user->phone_number);
            $this->assertNotEmpty($user->home_address);
            $this->assertNotEmpty($user->postcode);
        }
    }
}