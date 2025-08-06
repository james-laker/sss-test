<?php

namespace App\Console\Commands;

use App\Events\CreateTicket;
use App\Models\Ticket;
use Database\Factories\TicketFactory;
use Illuminate\Console\Command;

class CreateNewTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new ticket in the ticketing system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ticket = Ticket::factory()->create();

        event(new CreateTicket($ticket));
    }
}
