<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketsController extends Controller
{
    public function open(): AnonymousResourceCollection
    {
        return TicketResource::collection(
            Ticket::where('status', false)->get()
        );
    }

    public function closed(): AnonymousResourceCollection
    {
        return TicketResource::collection(
            Ticket::where('status', true)->get()
        );
    }
}
