<?php

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

        return env('ANIMEXX_EVENT_BASE_URL_JSON') . '?' . $httpQueryString;
    }
}

if (!function_exists('getDataForAnimexxMeetupSeries')) {
    function getDataForAnimexxMeetupSeries($id)
    {
        return json_decode(getExternalContent(getUrlForAnimexxMeetupSeries($id)));
    }
}

if (!function_exists('fetchMeetupDescriptionFor')) {
    function fetchMeetupDescriptionFor($id)
    {
        $crawler = new \Symfony\Component\DomCrawler\Crawler(getExternalContent('https://www.animexx.de/events/' . $id));

        $descriptions = $crawler->filter('.tabs-panel')->each(function (\Symfony\Component\DomCrawler\Crawler $node) {
            return $node->html();
        });

        return array_reduce($descriptions, function ($accum, $description) {
            return $accum . $description;
        }, '');
    }
}

if (!function_exists('getExternalContent')) {
    function getExternalContent($url)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        return $response->getBody()->getContents();
    }
}

if (!function_exists('replaceNewLines')) {
    function replaceNewLines($content, $delimiter = '')
    {
        return preg_replace("/\n|\t/", $delimiter, $content);
    }
}

if (!function_exists('purifyHtml')) {
    function purifyHtml($html)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($html);
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
        if ($bool == true || $bool == 1) {
            $str = __('common.lists.boolean.1');
        } else {
            $str = __('common.lists.boolean.0');
        }

        return $str;
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
    function storeGoogleEventFor(\App\Models\Meetup $meetup)
    {
        $googleEvent = new \Spatie\GoogleCalendar\Event();
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
        $googleEvents = \Spatie\GoogleCalendar\Event::get(\Illuminate\Support\Carbon::create(1990, 1, 1, 0, 0, 0));

        foreach ($googleEvents as $googleEvent) {
            $googleEvent->delete();
        }
    }
}

if (!function_exists('fetchDiscordWidgetApiContent')) {
    function fetchDiscordWidgetApiContent()
    {
        return json_decode(getExternalContent(env('DISCORD_WIDGET_API_URL')));
    }
}