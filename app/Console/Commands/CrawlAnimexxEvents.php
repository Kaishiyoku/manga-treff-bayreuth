<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\Event;
use Illuminate\Support\Collection;
use Symfony\Component\DomCrawler\Crawler;

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

        $crawler = new Crawler(getExternalContent(env('ANIMEXX_EVENT_BASE_URL')));

        $events = $crawler->filter('#beschreibungsseite_1 > table li > a')->each(function (Crawler $node) {
            return [
                'title' => $node->text(),
                'external_id' => (int)filter_var($node->attr('href'), FILTER_SANITIZE_NUMBER_INT),
            ];
        });

        $this->logInfo('Number of events: ' . count($events));
        $this->line('');

        $this->insertEvents(collect($events));

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

        foreach ($newEvents as $item) {
            $event = new Event($item);
            $event->save();

            $this->verbose(function () use ($item) {
                $this->line('Added event #' . $item['external_id']);
            });
        }
    }
}
