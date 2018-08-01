<?php

Route::group(['middleware' => ['menus']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/imprint', 'HomeController@imprint')->name('home.imprint');
    Route::get('/privacy_policy', 'HomeController@privacyPolicy')->name('home.privacy_policy');
    Route::get('/contact', 'HomeController@showContactForm')->name('home.show_contact_form');
    Route::post('/contact', 'HomeController@sendContactForm')->name('home.send_contact_form');

    Route::get('/events/upcoming', 'EventController@upcoming')->name('events.upcoming');
    Route::get('/events/past', 'EventController@past')->name('events.past');

    Auth::routes();

    Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', 'Admin\HomeController@index')->name('home.index');
        Route::resource('users', 'Admin\UserController');
    });
});