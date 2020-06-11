<?php

namespace App\Console\Commands;

use App\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotifyUsersForEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NotifyUsersForEvents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify the user for the event. test run with -> php artisan schedule:run';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::debug('this works every minute');

        $events = Event::query()->whereHas('settings', function ($query) {
            return $query->where('active', true);
        })->get();

        dd($events);

    }
}
