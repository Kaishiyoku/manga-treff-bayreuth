<?php

Route::group(['middleware' => ['menus']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/imprint', 'HomeController@imprint')->name('home.imprint');
    Route::get('/privacy_policy', 'HomeController@privacyPolicy')->name('home.privacy_policy');
    Route::get('/contact', 'HomeController@showContactForm')->name('home.show_contact_form');
    Route::post('/contact', 'HomeController@sendContactForm')->name('home.send_contact_form');

    Route::get('/events/upcoming', 'EventController@upcoming')->name('events.upcoming');
    Route::get('/events/past', 'EventController@past')->name('events.past');
    Route::resource('events', 'EventController')->only(['show']);

    Auth::routes();

    Route::get('/discord', 'HomeController@discord')->name('home.discord');

    /////////////////////
    // Logged on users //
    /////////////////////
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::get('/profile/login_attempts', 'ProfileController@loginAttempts')->name('profile.login_attempts');
        Route::get('/profile/active_sessions', 'ProfileController@activeSessions')->name('profile.active_sessions');
        Route::delete('/profile/destroy_session', 'ProfileController@destroySession')->name('profile.destroy_session');
        Route::get('/profile/email/edit', 'ProfileController@editEmail')->name('profile.edit_email');
        Route::put('/profile/email/edit', 'ProfileController@updateEmail')->name('profile.update_email');
        Route::get('/profile/email/confirm/{token}', 'ProfileController@confirmNewEmail')->name('profile.confirm_new_email');
        Route::get('/profile/password/change', 'ProfileController@editPassword')->name('profile.edit_password');
        Route::put('/profile/password/change', 'ProfileController@updatePassword')->name('profile.update_password');

        ////////////////////
        // Administrators //
        ////////////////////
        Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::get('/', 'Admin\HomeController@index')->name('home.index');
            Route::resource('users', 'Admin\UserController', ['except' => 'show']);
            Route::resource('events', 'Admin\EventController', ['except' => ['create', 'store', 'show']]);
        });
    });
});