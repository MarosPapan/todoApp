<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_login() {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('Hesloje123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'test@example.com',
            'password' => 'Hesloje123',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_logout() {
        $user = User::factory()->create();

        //$this->actingAs($user)->post(route('logout'));

        $response = $this->actingAs($user)->get(route('logout'));

        $response->assertRedirect(route('login'));
        $response->assertSessionHas("success", "Logged out successfully.");
    }

    /** @test */
    public function user_registration() {
        $registrationData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Hesloje123',
            'password_confirmation' => 'Hesloje123',
        ];

        $response = $this->post(route('register.post'), $registrationData);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHas("success", "Account created successfully. Please login.");
    }

    /** @test */
    public function registration_password_mismatch() {
        $registrationData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Hesloje123',
            'password_confirmation' => 'Hesloje123456', 
        ];

        $response = $this->from(route('register')) // Povieme testu, odkiaľ "prichádzame"
    ->post(route('register.post'), $registrationData);

        $response->assertRedirect(route('register'));
        //$response->assertSessionHas("error", "The password field confirmation does not match.");
        $response->assertSessionHasErrors([
            'password' => 'The password field confirmation does not match.'
        ]);
    }

    /** @test */
    public function login_invalid_credentials() {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('Hesloje123'),
        ]);

        $response = $this->post(route('login.post'), [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHas("error", "Invalid credentials");
        }
        
}
