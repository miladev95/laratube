<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function test_user_can_login()
    {

        $response = $this->post('/api/login', [
            'email' => 'user@example.com',
            'password' => '123'
        ]);
        $response->assertStatus(200);
    }

    public function test_user_can_register()
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(201);

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


        $response = $this->post('/api/register', $invalidData);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('users', ['email' => 'invalid_email']);
    }
}
