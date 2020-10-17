<?php

namespace App\Console\Commands;

use App\Models\Meetup;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Woeler\DiscordPhp\Exception\DiscordInvalidResponseException;
use Woeler\DiscordPhp\Message\DiscordTextMessage;
use Woeler\DiscordPhp\Webhook\DiscordWebhook;

class SendEventNotificationToDiscord extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discord:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an event notification to Discord';

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
        $nextUpcomingMeetup = Meetup::where('date_start', '>=', Carbon::today())->orderBy('date_start')->first();
        $diffInHours = now()->diffInHours($nextUpcomingMeetup->date_start);

        if (!empty($nextUpcomingMeetup) && $diffInHours <= 24 && $diffInHours > 23) {
            $formattedDate = $nextUpcomingMeetup->date_start->format('d.m.Y H:i');

            try {
                $message = (new DiscordTextMessage())->setContent("@everyone Nächstes Event am {$formattedDate}. Treffpunkt im Bahnhof");

                $webhook = new DiscordWebhook(config('site.discord_webhook_url'));
                $webhook->send($message);
            } catch (DiscordInvalidResponseException $e) {
                Log::error('Couldn\'t post to Discord. ' . $e->getMessage());
            }
        }
    }
}
