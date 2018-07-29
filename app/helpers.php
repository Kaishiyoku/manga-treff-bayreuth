<?php

if (!function_exists('getExternalContent')) {
    function getExternalContent($url)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get($url);

        return $response->getBody()->getContents();
    }
}
