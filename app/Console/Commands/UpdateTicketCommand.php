<?php

namespace App\Console\Commands;

use App\Events\UpdateTicket;
use App\Ticket\ResolveTicket;
use Illuminate\Console\Command;

class UpdateTicketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates status of ticket to resolved';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        new ResolveTicket();
    }
}
