<?php

namespace App\Console\Commands;

use App\Event;
use App\EventSettings;
use App\Item;
use App\Map;
use App\Program;
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
        $event->description = '<h1>test</h1>';
        $event->date_start = $date;
        $event->date_end = $date->copy()->addWeek();;
        $event->active = true;
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

        $program = new Program;
        $program->name = "some program";
        $program->type = Program::__PROGRAM__;
        $program->description = "testeesttes";
        $program->date_start = $date->copy()->addHour();
        $program->date_end = $date->copy()->addHour(3);
        $program->event_id = $event->id;
        $program->active = true;
        $program->save();

        $program = Program::query()->where('name', 'some program')->first();

        $item = new Item;
        $item->name = "Item 1";
        $item->type = Item::__KEYNOTES__;
        $item->description = "s simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting";
        $item->program_id = $program->id;
        $item->date_start = $date->copy()->addHour();
        $item->date_end = $date->copy()->addHour(1);
        $item->active = true;
        $item->save();

        $item = new Item;
        $item->name = "Item 2";
        $item->type = Item::__NONE__;
        $item->description = "seeeee simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting's simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting";
        $item->program_id = $program->id;
        $item->date_start = $date->copy()->addHour();
        $item->date_end = $date->copy()->addHour(1);
        $item->active = true;
        $item->save();

        $map = new Map;
        $map->name = "Map name";
        $map->json = "{}";
        $map->event_id = $event->id;
        $map->active = true;
        $map->save();

        return 'success created fake event';
    }
}
