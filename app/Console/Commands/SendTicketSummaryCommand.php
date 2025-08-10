<?php

namespace App\Console\Commands;

use App\Ticket\TicketSummary;
use Illuminate\Console\Command;

class SendTicketSummaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ticket:summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send user ticket summary';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $handle = new TicketSummary;
    }
}
