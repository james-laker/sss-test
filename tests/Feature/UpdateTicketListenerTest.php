<?php

use App\Events\UpdateTicket;
use App\Listeners\ResolveTicketListener;
use App\Models\Ticket;
use Illuminate\Support\Facades\Artisan;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    Artisan::call('db:seed', ['--class' => 'UserSeeder']);
});

it('calls the ResolveTicket listener and updates ticket status', function () {
    $ticket = Ticket::factory()->create([
        'status' => 0,
    ]);

    $event = new UpdateTicket($ticket);
    $listener = new ResolveTicketListener();

    $listener->handle($event);

    assertDatabaseHas('tickets', [
        'id' => $ticket->id,
        'status' => 1,
    ]);
});
