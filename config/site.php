<?php

return [

    // Animexx

    'animexx_event_series_id' => env('ANIMEXX_EVENT_SERIES_ID'),
    'animexx_event_base_url' => env('ANIMEXX_EVENT_BASE_URL'),
    'animexx_event_base_url_json' => env('ANIMEXX_EVENT_BASE_URL_JSON'),
    'animexx_event_default_address' => env('ANIMEXX_EVENT_DEFAULT_ADDRESS'),
    'animexx_event_default_start_time' => env('ANIMEXX_EVENT_DEFAULT_START_TIME'),
    'animexx_event_default_end_time' => env('ANIMEXX_EVENT_DEFAULT_END_TIME'),
    'default_contact_id' => env('DEFAULT_CONTACT_ID'),

    'short_event_base_url' => env('SHORT_EVENT_BASE_URL'),

    // Discord server

    'discord_widget_api_url' => env('DISCORD_WIDGET_API_URL'),
    'discord_webhook_url' => env('DISCORD_WEBHOOK_URL'),

    // website-specific
    'app_admin_email' => env('APP_ADMIN_EMAIL'),

    'app_name' => env('APP_NAME'),
    'app_version' => env('APP_VERSION'),

    'google_calendar_public_url' => env('GOOGLE_CALENDAR_PUBLIC_URL'),

];
