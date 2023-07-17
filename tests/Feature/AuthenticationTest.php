<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '123'
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_can_access_protected_route()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_protected_route()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    }

    public function test_user_can_register()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $response = $this->post('/register', $userData);

        $response->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
    }

    public function test_user_cannot_register_with_invalid_data()
    {
        $invalidData = [
            'name' => '',
            'email' => 'invalid_email',
            'password' => '123',
            'password_confirmation' => 'wrong_password',
        ];

        $response = $this->post('/register', $invalidData);
        $response->assertSessionHasErrors(['name', 'email', 'password_confirmation']);

        $this->assertDatabaseMissing('users', ['email' => 'invalid_email']);
    }
}
