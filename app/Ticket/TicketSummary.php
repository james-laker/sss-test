<?php

namespace App\Ticket;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketSummaryEmail;

class TicketSummary
{

    public static function sendSummary()
    {
        $users = User::with(['tickets' => function ($query) {
            $query->where('status', false);
        }])->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new TicketSummaryEmail($user->name, $user->tickets));
        }
    }
}
