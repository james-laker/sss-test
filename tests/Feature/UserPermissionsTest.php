<?php

use App\Events\UpdateTicket;
use App\Models\Ticket;
use App\Models\User;
use App\Ticket\ResolveTicket;
use Illuminate\Support\Facades\Event;
use function Pest\Laravel\actingAs;

beforeEach(function () {
    $this->ticket = Ticket::factory()->create();
});

it('only allows user with admin permissions to mark ticket as resolved', function () {
    Event::fake();

    $user = User::factory()->create(['role' => 1]);
    actingAs($user);

    new ResolveTicket($this->ticket);

    Event::assertDispatched(UpdateTicket::class, fn ($event) => $event->ticket->id === $this->ticket->id);
});

it('prevents user without role 1 from dispatching UpdateTicket event', function () {
    Event::fake();

    $user = User::factory()->create(['role' => 2]);
    actingAs($user);

    $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);

    new ResolveTicket($this->ticket);
});
