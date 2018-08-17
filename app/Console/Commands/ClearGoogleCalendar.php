<?php

namespace App\Console\Commands;

use App\Console\BaseCommand;
use Illuminate\Support\Carbon;
use Spatie\GoogleCalendar\Event as GoogleEvent;

class ClearGoogleCalendar extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google_calendar:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the google calendar';

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
        if ($this->confirm('Are you sure?')) {
            $start = microtime(true);

            clearGoogleCalendar();

            $timeElapsedInSeconds = microtime(true) - $start;

            $this->line('');
            $this->logInfo('...finished. Duration: ' . number_format($timeElapsedInSeconds, 2) . ' seconds.');
            $this->line('');
        }
    }
}