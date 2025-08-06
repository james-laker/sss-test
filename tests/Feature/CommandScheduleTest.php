<?php

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;



it('schedules the create ticket command to run every minute', function () {
    $schedule = app(Schedule::class);
    $events = collect($schedule->events());

    $commandScheduled = $events->contains(function ($event) {
        return str_contains($event->command, 'ticket:create') &&
            $event->expression === '* * * * *';
    });

    expect($commandScheduled)->toBeTrue();
});

it('schedules the update ticket command to run every 5 minutes', function () {
    $schedule = app(Schedule::class);
    $events = collect($schedule->events());

    User::factory()->create(['role' => 1]);

    $commandScheduled = $events->contains(function ($event) {
        return str_contains($event->command, 'ticket:update') &&
            $event->expression === '*/5 * * * *';
    });

    expect($commandScheduled)->toBeTrue();
});
