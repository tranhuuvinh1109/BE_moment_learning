<?php

namespace Tests\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations, WithFaker;

    public function test_user_can_login()
{
    // Create a user
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt('password'),
        'address' => 'address',
        'fullname' => 'fullname'
    ]);

    // Make a request to the login endpoint
    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
        'address' => 'address',
        'fullname' => 'fullname'
    ]);

    // Assert the response structure and status
    $response->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'avatar',
                'phone',
                'address',
                'fullname',
                'created_at',
                'updated_at',
            ],
            'token', // Ensure 'token' key is present
        ]);

    // Optionally, you can assert specific user details in the response
    $response->assertJson([
        'data' => [
            'email' => $user->email,
            // Add other expected details
        ],
    ]);
}


    public function test_user_cannot_login_with_invalid_credentials()
    {
         // Make a request to the login endpoint with invalid credentials
    $response = $this->postJson('/api/login', [
        'email' => 'invalid@example.com',
        'password' => 'invalidpassword',
    ]);

    // Assert the response structure and status
    $response->assertStatus(401)
        ->assertJson([
            'success' => false,
            'message' => 'Invalid credentials',
        ]);

    // Optionally, you can assert that certain keys are not present in the response
    $response->assertJsonMissing([
        'data',
        'token',
    ]);
    }
}
