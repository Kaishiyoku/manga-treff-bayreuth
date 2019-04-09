<?php

namespace App\Console\Commands;

use App\Models\Meetup;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use RestCord\DiscordClient;

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
     * @var DiscordClient
     */
    private $discordClient;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->discordClient = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);
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

            $this->discordClient->channel->createMessage([
                'channel.id' => 476121162456367125,
                'content' => "@everyone Nächstes Event am {$formattedDate}. Treffpunkt im Bahnhof",
            ]);
        }
    }
}
