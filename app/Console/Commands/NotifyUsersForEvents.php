<?php

namespace App\Console\Commands;

use App\Event;
use App\Mail\NotifyUserOfEventsMail;
use App\RegistrationEvents;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $events = Event::query()
            ->with('settings')
            ->has('settings')
            ->get();

        foreach ($events as $event) {
            $week = Carbon::now()->addWeek();
            $sixDays = $week->copy()->subDay();
            if (Carbon::create($event->settings->date_start)->between($week, $sixDays)) {
                $subscriptions = RegistrationEvents::query()
                    ->where('event_id', $event->id)
                    ->get();
                foreach ($subscriptions as $subscription) {
                    $user = User::findOrFail($subscription->user_id);
                    Mail::to($user->email)->queue(new NotifyUserOfEventsMail($event));
                }
            }
        }
    }
}
