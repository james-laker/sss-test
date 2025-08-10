<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class UserTicketsController extends Controller
{
    public function __invoke($email) {
        $user = User::where('email', $email)->first();

        return TicketResource::collection(
            Ticket::where('user_id', $user->id)->get()
        );
    }
}
