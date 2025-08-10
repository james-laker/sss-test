<?php

namespace App\Ticket;

use App\Events\UpdateTicket;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ResolveTicket
{
    public function __construct(private ?Ticket $ticket = null)
    {
        if (!$this->ticket) {
            $this->ticket = Ticket::where('status', false)->orderBy('created_at', 'asc')->first();
        }
        $this->action();
    }

    public function action(): void
    {
        if (Auth::user()->role === 1) {
            event(new UpdateTicket($this->ticket));
        } else {
            abort(403); // unauthorised
        }
    }
}
