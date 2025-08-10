<?php

use App\Models\User;

it('allows a user to login with valid credentials', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'token',
        ]);
});

it('rejects invalid login credentials', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'invalid@example.com',
        'password' => 'wrongpass',
    ]);

    $response->assertStatus(422);
});
