<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\Event;
use App\Models\EventType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CrawlAnimexxEvents extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'animexx:crawl_events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawls for Animexx events';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, 'German');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = microtime(true);

        $this->logInfo('Crawling events...this will take some time.');
        $this->line('');

        $json = getDataForAnimexxEventSeries(env('ANIMEXX_EVENT_SERIES_ID'));

        $events = collect();

        foreach ($json->data->events as $animexxEvent) {
            $eventType = EventType::find($animexxEvent->type->id);

            if ($eventType == null) {
                $eventType = new EventType();
                $eventType->external_id = $animexxEvent->type->id;
                $eventType->title = $animexxEvent->type->title;
                $eventType->description = $animexxEvent->type->description;
                $eventType->color = $animexxEvent->type->color;
                $eventType->parent_id = $animexxEvent->type->parent;
                $eventType->save();
            }

            $event = new Event();
            $event->external_id = $animexxEvent->id;
            $event->address = $animexxEvent->address;
            $event->name = $animexxEvent->name;
            $event->date_start = new Carbon($animexxEvent->dateStart->date, $animexxEvent->dateStart->timezone);
            $event->date_end = new Carbon($animexxEvent->dateEnd->date, $animexxEvent->dateEnd->timezone);
            $event->zip = $animexxEvent->zip;
            $event->city = $animexxEvent->city;
            $event->state = $animexxEvent->state;
            $event->contact_id = (int) filter_var($animexxEvent->contact, FILTER_SANITIZE_NUMBER_INT);;
            $event->attendees = $animexxEvent->attendees;
            $event->intro = $animexxEvent->intro;
            $event->main_image = $animexxEvent->mainImage;
            $event->logo_image = $animexxEvent->logoImage;
            $event->country = $animexxEvent->country;
            $event->geo_lat = $animexxEvent->geoLat;
            $event->geo_long = $animexxEvent->geoLong;
            $event->geo_zoom = $animexxEvent->geoZoom;
            $event->geo_type = $animexxEvent->geoType;
            $event->event_type_external_id = $animexxEvent->type->id;

            $events->push($event);
        }


        $this->logInfo('Number of events: ' . count($events));
        $this->line('');

        $this->insertEvents($events);

        $timeElapsedInSeconds = microtime(true) - $start;

        $this->line('');
        $this->logInfo('...finished. Duration: ' . number_format($timeElapsedInSeconds, 2) . ' seconds.');
        $this->line('');
    }

    private function insertEvents(Collection $events)
    {
        $externalIds = Event::whereNotNull('external_id')->pluck('external_id')->toArray();

        $newEvents = $events->filter(function ($event) use ($externalIds) {
            return !in_array($event['external_id'], $externalIds);
        });

        $this->logInfo('Number of new events: ' . count($newEvents));
        $this->line('');

        foreach ($newEvents as $i => $event) {
            $event->save();

            storeGoogleEventFor($event);

            $this->verbose(function () use ($event) {
                $this->line('Added event #' . $event->external_id);
            });
        }
    }
}
