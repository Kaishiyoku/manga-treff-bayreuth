<?php

return [
    'index' => [
        'title' => 'Profil',
        'registered_at' => 'Registriert am',
        'options' => 'Optionen',
    ],
    'login_attempts' => [
        'title' => 'Login-Versuche',
        'the_last_logins_are_shown' => 'Es werden die letzten Logins innerhalb der letzten 14 Tage angezeigt.',
    ],
    'active_sessions' => [
        'title' => 'Aktive Sitzungen',
        'here_are_all_your_sessions_displayed' => 'Hier werden all Ihre aktiven Sitzungen angezeigt. Bei Bedarf können Sie einzelne Sitzungen manuell beenden.',
        'current_session_info' => 'Beachten Sie, dass Sie auch Ihre aktuell verwendete Sitzung beenden können.',
        'destroy' => 'Session jetzt beenden',
    ],
    'destroy_session' => [
        'success' => 'Ausgewählte Session beendet.',
    ],
    'edit_password' => [
        'title' => 'Passwort ändern',
        'submit' => 'Neues Passwort setzen',
        'success' => 'Passwort geändert.',
        'invalid_current_password' => 'Das derzeitige Passwort ist falsch.',
    ],
    'edit_email' => [
        'title' => 'E-Mail-Adresse ändern',
        'submit' => 'Neue Adresse speichern',
        'success' => 'E-Mail-Adresse geändert. Es wurde eine Bestätigungsmail an Ihre derzetige E-Mail-Adresse gesendet, um die Änderung zu bestätigen.'
    ],
    'confirm_new_email' => [
        'invalid_token' => 'Bestätigungstoken ungültig.',
        'success' => 'Neue E-Mail-Adresse erfolgreich bestätigt. Sie wurden automatisch ausgeloggt. Bitte loggen Sie sich mit Ihrer neuen E-Mail-Adresse erneut an.'
    ],
    'emails' => [
        'new_email' => [
            'title' => 'Neue E-Mail-Adresse bestätigen',
            'you_have_changed_your_email_and_must_confirm_it' => 'Sie haben eine neue E-Mail-Adresse für Ihren Account gesetzt. Bitte bestätigen Sie Ihre Änderung durch Aufruf des nachfolgenden Links.',
            'new_email_address' => 'Neue E-Mail-Adresse: :email',
        ],
    ],
    'delete_account' => [
        'title' => 'Account löschen',
        'confirmation_text' => 'Willst du deinen Account wirklich löschen? Dieser Vorgang kann nicht rückgängig gemacht werden.',
        'submit' => 'Account unwiderruflich löschen',
        'success' => 'Dein Account wurde gelöscht und du wurdest automatisch ausgeloggt.',
    ],
];
