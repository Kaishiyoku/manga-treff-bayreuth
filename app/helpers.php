<?php

use App\Models\Meetup;
use App\Models\VisitorNotice;
use GrahamCampbell\Security\Facades\Security;
use Illuminate\Support\Carbon;
use \Illuminate\Support\Facades\Http;
use Bueltge\Marksimple\Marksimple;
use Illuminate\Support\Str;
use \Spatie\GoogleCalendar\Event as GoogleEvent;
use Symfony\Component\CssSelector\CssSelectorConverter;
use Symfony\Component\DomCrawler\Crawler;

if (!function_exists('getUrlForAnimexxMeetupSeries')) {
    function getUrlForAnimexxMeetupSeries($id)
    {
        $httpQueryString = http_build_query([
            'filter' => [
                'search' => '',
                'includePast' => true,
                'includeSubEvents' => false,
                'isAnimexx' => false,
                'attendees' => 'ka',
                'series' => $id,
                'offset' => 0,
                'limit' => null,
            ],
        ]);

        return config('site.animexx_event_base_url_json') . '?' . $httpQueryString;
    }
}

if (!function_exists('getDataForAnimexxMeetupSeries')) {
    function getDataForAnimexxMeetupSeries($id)
    {
        return json_decode(getExternalContent(getUrlForAnimexxMeetupSeries($id)));
    }
}

if (!function_exists('getAnimexxUrlForEvent')) {
    function getAnimexxUrlForEvent($id)
    {
        return 'https://www.animexx.de/events/' . $id;
    }
}

if (!function_exists('fetchMeetupDescriptionFor')) {
    function fetchMeetupDescriptionFor($html)
    {
        $crawler = new Crawler($html);

        $descriptions = $crawler->filter('.tabs-panel')->each(function (Crawler $node) {
            return $node->html();
        });

        return array_reduce($descriptions, function ($accum, $description) {
            return $accum . $description;
        }, '');
    }
}

if (!function_exists('fetchMeetupUserRegistrationsFor')) {
    function fetchMeetupUserRegistrationsFor($html)
    {
        $crawler = new Crawler($html);
        $cssSelector = new CssSelectorConverter();

        $users = $crawler
            ->filterXPath($cssSelector->toXPath('#event-participants > .reveal-content .user.username'))
            ->each(function (Crawler $node) {
                preg_match('/\?id=\d+/', $node->html(), $matches);
                [$firstMatch] = $matches;

                $id = (int) Str::substr($firstMatch, 4);
                $name = $node->text();

                return compact('id', 'name');
            });

        return collect($users);
    }
}

if (!function_exists('getExternalContent')) {
    function getExternalContent($url)
    {
        return Http::get($url)->body();
    }
}

if (!function_exists('getExternalJson')) {
    function getExternalJson($url)
    {
        return json_decode(Http::get($url)->body());
    }
}

if (!function_exists('replaceNewLines')) {
    function replaceNewLines($content, $delimiter = '')
    {
        return preg_replace("/\n|\t/", $delimiter, $content);
    }
}

if (!function_exists('cleanHtml')) {
    function cleanHtml($html)
    {
        return Security::clean($html);
    }
}

if (!function_exists('truncateHtml')) {
    function truncateHtml($html, $length, $options = array())
    {
        return HtmlTruncator\Truncator::truncate($html, $length, $options);
    }
}

if (!function_exists('formatBoolean')) {
    function formatBoolean($bool)
    {
        return $bool == true || $bool == 1 ? __('common.yes') : __('common.no');
    }
}

if (!function_exists('translateLoginAttemptStatus')) {
    function translateLoginAttemptStatus($status)
    {
        return __('common.lists.login_attempt_status.' . $status);
    }
}

if (!function_exists('convertEncoding')) {
    function convertEncoding($str)
    {
        return mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    }
}

if (!function_exists('storeGoogleEventFor')) {
    function storeGoogleEventFor(Meetup $meetup)
    {
        $googleEvent = new GoogleEvent();
        $googleEvent->name = $meetup->name;
        $googleEvent->location = $meetup->getMeetupLocation();
        $googleEvent->description = convertEncoding($meetup->description);
        $googleEvent->startDateTime = $meetup->date_start;
        $googleEvent->endDateTime = $meetup->date_end;
        $googleEvent->save();
    }
}

if (!function_exists('clearGoogleCalendar')) {
    function clearGoogleCalendar()
    {
        $minDate = Carbon::create(1990, 1, 1, 0, 0, 0);

        $googleEvents = GoogleEvent::get(null, null, ['timeMin' => $minDate->toISOString()]);

        foreach ($googleEvents as $googleEvent) {
            $googleEvent->delete();
        }
    }
}

if (!function_exists('fetchDiscordWidgetApiContent')) {
    function fetchDiscordWidgetApiContent()
    {
        return getExternalJson(config('site.discord_widget_api_url'));
    }
}

if (!function_exists('parseMarkdown')) {
    function parseMarkdown(string $content): string
    {
        $markSimple = new Marksimple();
        $markSimple->removeRule('header');
        $markSimple->removeRule('ul');
        $markSimple->removeRule('cleanuplist');
        $markSimple->removeRule('pre');
        $markSimple->removeRule('cleanuppre');
        $markSimple->removeRule('githubpre');
        $markSimple->removeRule('code');

        return cleanHtml($markSimple->parse($content));
    }
}

if (!function_exists('visitorNoticesForToday')) {
    function visitorNoticesForToday()
    {
        return VisitorNotice::today()->orderBy('starting_at')->orderBy('ending_at');
    }
}

if (!function_exists('getAnimexxUserProfileUrlFor')) {
    function getAnimexxUserProfileUrlFor($id)
    {
        return 'https://www.animexx.de/mitglieder/steckbrief.php?id=' . $id;
    }
}

if (!function_exists('getBooleanInputList')) {
    function getBooleanInputList()
    {
        return [
            0 => __('common.no'),
            1 => __('common.yes'),
        ];
    }
}
