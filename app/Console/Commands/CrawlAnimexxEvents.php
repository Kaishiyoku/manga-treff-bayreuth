<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\Event;
use Illuminate\Support\Carbon;
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

        $events = $crawler->filter('#beschreibungsseite_1 > table ul > li')->each(function (Crawler $node) {
            preg_match("/[0-3][0-9].[01][0-9].[1-3][0-9][0-9][0-9]/", $node->text(), $matches);
            $date = Carbon::createFromFormat('d.m.Y', array_first($matches));
            $externalId = (int)filter_var($node->children()->first()->attr('href'), FILTER_SANITIZE_NUMBER_INT);

            $eventDetailsCrawler = new Crawler(getExternalContent(env('ANIMEXX_EVENT_BASE_URL') . '/' . $externalId));

            $eventDetailsXPath = collect([3, 4, 5, 11])->map(function ($number) {
                return "(//div[contains(@class, 'beschreibungsseite')]//td)[$number]";
            })->implode('|');

            $detailNodes = $eventDetailsCrawler->filterXPath($eventDetailsXPath)->each(function (Crawler $detailNode, $i) {
                if ($i == 0) {
                    return preg_replace('/Treffpunkt/', '', preg_replace("/\r/", ', ', replaceNewLines($detailNode->text())));
                }

                return $detailNode->html();
            });

            list($address, $category, $size, $description) = $detailNodes;

            $this->verbose(function () use ($externalId) {
                $this->line('Crawled event #' . $externalId);
            });

            return [
                'date' => $date,
                'external_id' => $externalId,
                'address' => $address,
                'category' => $category,
                'size' => $size,
                'description' => $description,
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
