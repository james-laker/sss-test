<?php

use App\Models\Ticket;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns stats for authenticated users', function () {
    $user = User::factory()->create();
    Ticket::factory()->count(10)->create();

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/stats');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'total',
            'unprocessed',
            'top_user_name',
            'top_user_email',
            'last_processed',
        ]);
});
