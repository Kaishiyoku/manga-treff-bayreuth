<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\Meetup;
use App\Models\MeetupType;
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

        $json = getDataForAnimexxMeetupSeries(config('site.animexx_event_series_id'));

        $meetups = collect();

        foreach ($json->data->events as $animexxEvent) {
            $meetupType = MeetupType::find($animexxEvent->type->id);

            if ($meetupType == null) {
                $meetupType = new MeetupType();
                $meetupType->external_id = $animexxEvent->type->id;
                $meetupType->name = $animexxEvent->type->title;
                $meetupType->description = $animexxEvent->type->description;
                $meetupType->color = $animexxEvent->type->color;
                $meetupType->parent_id = $animexxEvent->type->parent;
                $meetupType->save();
            }

            $meetup = new Meetup();
            $meetup->external_id = $animexxEvent->id;
            $meetup->address = $animexxEvent->address ?? config('site.animexx_event_default_address');
            $meetup->name = $animexxEvent->name;
            $meetup->slug = $animexxEvent->slug;

            $meetup->date_start = new Carbon($animexxEvent->dateStart->date, $animexxEvent->dateStart->timezone);
            $meetup->date_end = new Carbon($animexxEvent->dateEnd->date, $animexxEvent->dateEnd->timezone);

            if ($meetup->date_start == $meetup->date_end) {
                $getDefaultTime = function ($str) {
                    return explode(':', $str);
                };

                $meetup->date_start = $meetup->date_start->setTime(...$getDefaultTime(config('site.animexx_event_default_start_time')));
                $meetup->date_end = $meetup->date_start->setTime(...$getDefaultTime(config('site.animexx_event_default_end_time')));
            }

            $meetup->zip = $animexxEvent->zip;
            $meetup->city = $animexxEvent->city;
            $meetup->state = $animexxEvent->state;
            $meetup->contact_id = (int) filter_var($animexxEvent->contact, FILTER_SANITIZE_NUMBER_INT);
            $meetup->attendees = $animexxEvent->attendees;
            $meetup->intro = $animexxEvent->intro;
            $meetup->main_image = $animexxEvent->mainImage;
            $meetup->logo_image = $animexxEvent->logoImage;
            $meetup->country = $animexxEvent->country;
            $meetup->geo_lat = $animexxEvent->geoLat;
            $meetup->geo_long = $animexxEvent->geoLong;
            $meetup->geo_zoom = $animexxEvent->geoZoom;
            $meetup->geo_type = $animexxEvent->geoType;
            $meetup->meetup_type_external_id = $animexxEvent->type->id;

            $meetups->push($meetup);
        }

        $this->logInfo('Number of events: ' . count($meetups));
        $this->line('');

        $this->insertMeetups($meetups);

        Meetup::whereIsManuallyAdded(false)->each(function (Meetup $meetup) {
            $html = getExternalContent(getAnimexxUrlForEvent($meetup->external_id));
            $userRegistrations = fetchMeetupUserRegistrationsFor($html);

            $animexx_data = $meetup->animexx_data;
            $animexx_data['user_registrations'] = $userRegistrations->toArray();

            $meetup->animexx_data = $animexx_data;

            $meetup->save();
        });

        $timeElapsedInSeconds = microtime(true) - $start;

        $this->line('');
        $this->logInfo('...finished. Duration: ' . number_format($timeElapsedInSeconds, 2) . ' seconds.');
        $this->line('');
    }

    private function insertMeetups(Collection $meetups)
    {
        $externalIds = Meetup::whereNotNull('external_id')->pluck('external_id')->toArray();

        $newMeetups = $meetups->filter(function ($meetup) use ($externalIds) {
            return !in_array($meetup['external_id'], $externalIds);
        });

        $this->logInfo('Number of new events: ' . count($newMeetups));
        $this->line('');

        foreach ($newMeetups as $i => $meetup) {
            $html = getExternalContent(getAnimexxUrlForEvent($meetup->external_id));

            $meetup->description = fetchMeetupDescriptionFor($html);

            $meetup->save();

            storeGoogleEventFor($meetup);

            $this->verbose(function () use ($meetup) {
                $this->line('Added event #' . $meetup->external_id);
            });
        }
    }
}
