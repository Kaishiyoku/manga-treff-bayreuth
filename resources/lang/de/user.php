<?php

return [
    'index' => [
        'title' => 'Benutzerliste',
    ],
    'show' => [
        'title' => 'Profil von :name',
        'about_me_empty' => ':name hat noch nichts über sich geschrieben.',
    ],
    'admin' => [
        'index' => [
            'title' => 'Benutzer',
            'new_user' => 'Neuer Benutzer',
        ],
        'create' => [
            'title' => 'Neuer Benutzer',
            'success' => 'Benutzer erstellt.',
        ],
        'edit' => [
            'title' => 'Benutzer „:name” ändern',
            'password_help' => 'Leer lassen, um aktuelles Passwort beizubehalten.',
            'success' => 'Benutzer geändert.',
        ],
        'destroy' => [
            'you_cannot_delete_your_own_account' => 'Sie können nicht Ihren eigenen Account löschen.',
            'administrators_cannot_be_deleted' => 'Administratoren können nicht gelöscht werden.',
            'success' => 'Benutzer gelöscht.',
        ],
        'is_email_verified' => 'Verifiziert',
    ],
];
