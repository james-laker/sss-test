<?php

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = User::factory()->create();
    Artisan::call('db:seed', ['--class' => 'UserSeeder']);
    Sanctum::actingAs($this->user);
});

it('returns open tickets', function () {
    Ticket::factory()->count(2)->create(['status' => false]);
    Ticket::factory()->count(1)->create(['status' => true]);

    $response = $this->getJson('/api/open');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

it('returns closed tickets', function () {
    Ticket::factory()->count(2)->create(['status' => true]);
    Ticket::factory()->count(1)->create(['status' => false]);

    $response = $this->getJson('/api/closed');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
});
