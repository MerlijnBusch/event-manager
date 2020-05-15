<?php

namespace App\Console\Commands;

use App\Event;
use App\EventSettings;
use App\Item;
use App\Map;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateEventData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate fake event data to test with';

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
        $date = Carbon::now()->addWeek();

        $event = New Event;
        $event->name = 'The cool kids invation event';
        $event->description = 's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of ';
        $event->date = $date;
        $event->save();

        $event = Event::query()->where('name', 'The cool kids invation event')->first();

        $settings = new EventSettings;
        $settings->event_id = $event->id;
        $settings->visible_registrations = EventSettings::__VISIBLE_REGISTRATIONS__;
        $settings->max_registrations = EventSettings::__MAX_REGISTRATIONS__;
        $settings->primary_color = "#7d4497";
        $settings->secondary_color = "#649744";
        $settings->active = true;
        $settings->save();

        $item = new Item;
        $item->name = "Item 1";
        $item->type = Item::__KEYNOTES__;
        $item->description = "s simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting";
        $item->event_id = $event->id;
        $item->date = $date->copy()->addHour();
        $item->active = true;
        $item->save();

        $map = new Map;
        $map->name = "Map name";
        $map->json = "{}";
        $map->event_id = $event->id;
        $map->active = true;
        $map->save();
    }
}
