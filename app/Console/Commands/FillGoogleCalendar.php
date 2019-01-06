<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use App\Models\Event;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Spatie\GoogleCalendar\Event as GoogleEvent;

class FillGoogleCalendar extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google_calendar:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fills the google calendar';

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
        if ($this->confirm('Are you sure?')) {
            $start = microtime(true);

            clearGoogleCalendar();

            foreach (Event::all() as $event) {
                $this->verbose(function () use ($event) {
                    $this->line(' ' . $event->date);
                });

                storeGoogleEventFor($event);
            }

            $timeElapsedInSeconds = microtime(true) - $start;

            $this->line('');
            $this->logInfo('...finished. Duration: ' . number_format($timeElapsedInSeconds, 2) . ' seconds.');
            $this->line('');
        }
    }
}