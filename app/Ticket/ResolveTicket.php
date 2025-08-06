<?php

namespace App\Ticket;

use App\Events\UpdateTicket;
use App\Models\Ticket;

class ResolveTicket
{
    public function __construct(private readonly ?Ticket $ticket = null)
    {
        if (!$this->ticket) {
            $this->ticket_id = Ticket::orderBy('created_at', 'desc')->first()->id;
        } else {
            $this->ticket_id = $this->ticket->id;
        }
        $this->action();
    }

    public function action(): void
    {
        event(new UpdateTicket($this->ticket_id));
    }
}
