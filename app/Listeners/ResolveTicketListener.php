<?php

namespace App\Listeners;

use App\Events\UpdateTicket;
use App\Models\Ticket;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ResolveTicketListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateTicket $event): void
    {
        $event->ticket->update(['status' => 1]);
    }
}
