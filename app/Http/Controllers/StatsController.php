<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function __invoke()
    {
        $tickets = Ticket::orderBy('updated_at', 'desc')->get();

        $topUser = User::withCount('tickets')
            ->orderByDesc('tickets_count')
            ->first();

        return [
            'total' => $tickets->count(),
            'unprocessed' => $tickets->where('status', false)->count(),
            'top_user_name' => $topUser->name,
            'top_user_email' => $topUser->email,
            'last_processed' => $tickets->first()->updated_at->format('d/m/Y H:i'),
        ];
    }
}
