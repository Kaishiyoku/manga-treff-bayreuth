<?php

return [
    'show' => [
        'registration' => [
            'title_alternative' => 'Anmeldungen',
            'title' => '{0} Noch keine Teilnehmer|{1} Ein Teilnehmer|[2,*] :count Teilnehmer',
            'email_not_verified' => 'Bevor Sie sich zu einem Treffen anmelden können, müssen Sie Ihre E-Mail bestätigen.',
            'registration_via_animexx_only' => 'Wenn Sie sich für dieses Treffen anmelden möchten, tun Sie dies über das Animexx-Event',
            'create' => [
                'title' => 'Teilnahme',
                'register_success' => 'Anmeldung erfolgreich.',
                'unregister_success' => 'Anmeldung zurückgezogen.',
            ],
            'edit' => [
                'title' => 'Teilnahme anpassen',
                'unregister_confirm' => 'Teilnahme wirklich zurückziehen?',
                'success' => 'Anmeldung angepasst',
            ],
            'register' => 'Teilnehmen',
            'unregister' => 'Teilnahme zurückziehen',
        ],
    ],
    'admin' => [
        'index' => [
            'title' => 'Treffen',
            'new_meetup' => 'Neues Treffen',
            'animexx_event' => 'Animexx Event',
            'is_manually_added' => 'Eigenes erstelltes Event'
        ],
        'create' => [
            'title' => 'Treffen erstellen',
            'success' => 'Treffen erstellt.',
        ],
        'edit' => [
            'title' => 'Treffen „:name” ändern',
            'success' => 'Treffen gespeichert.',
        ],
        'destroy' => [
            'success' => 'Treffen gelöscht.',
        ],
    ],
];
