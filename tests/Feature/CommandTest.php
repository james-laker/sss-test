<?php

use App\Events\CreateTicket;
use App\Events\UpdateTicket;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Event;

beforeEach(function () {
    User::factory()->create(['role' => 1]);
});

it('fires CreateTicket event when ticket:create command runs', function () {
    Event::fake();

    $this->artisan('ticket:create')
        ->assertExitCode(0);

    Event::assertDispatched(CreateTicket::class);
});

it('fires UpdateTicket event when ticket:update command runs', function () {
    Event::fake();

    Ticket::factory()->create();

    $this->artisan('ticket:update')
        ->assertExitCode(0);

    Event::assertDispatched(UpdateTicket::class);
});
