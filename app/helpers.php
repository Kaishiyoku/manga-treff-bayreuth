<?php

if (!function_exists('getUrlForAnimexxEventSeries')) {
    function getUrlForAnimexxEventSeries($id)
    {
        $httpQueryString = http_build_query([
            'filter' => [
                'search' => '',
                'includePast' => true,
                'includeSubEvents' => false,
                'isAnimexx' => false,
                'timeframe' => 'past',
                'attendees' => 'ka',
                'series' => $id,
                'offset' => 0,
                'limit' => null,
            ],
        ]);

        return env('ANIMEXX_EVENT_BASE_URL_JSON') . '?' . $httpQueryString;
    }
}

if (!function_exists('getDataForAnimexxEventSeries')) {
    function getDataForAnimexxEventSeries($id)
    {
        return json_decode(getExternalContent(getUrlForAnimexxEventSeries($id)));
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

if (!function_exists('storeGoogleEventFrom')) {
    function storeGoogleEventFrom(\App\Models\Event $event)
    {
        $googleEvent = new \Spatie\GoogleCalendar\Event();
        $googleEvent->name = convertEncoding(env('APP_NAME') . ' (' . $event->date_start->formatLocalized('%B') . ')');
        $googleEvent->location = $event->address;
//        $googleEvent->description = convertEncoding($event->description);
        $googleEvent->startDateTime = $event->date_start->setTime(...explode(':', env('ANIMEXX_EVENT_DEFAULT_START_TIME')));
        $googleEvent->endDateTime = $event->date_start->setTime(...explode(':', env('ANIMEXX_EVENT_DEFAULT_END_TIME')));
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