<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_user_registration()
    {
        $response = $this->postJson('/register', [
            'name' => 'Gleison Sena',
            'email' => 'terrasamba@terra.com.br',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Registro Realizado com sucesso']);

        $this->assertDatabaseHas('users', [
            'email' => 'terrasamba@terra.com.br',
        ]);
    }
}
