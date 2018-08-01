<?php

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
            $str = trans('common.lists.boolean.1');
        } else {
            $str = trans('common.lists.boolean.0');
        }

        return $str;
    }
}