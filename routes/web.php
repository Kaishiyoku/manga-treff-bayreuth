<?php

Route::group(['middleware' => ['menus']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/imprint', 'HomeController@imprint')->name('home.imprint');
    Route::get('/privacy_policy', 'HomeController@privacyPolicy')->name('home.privacy_policy');

    Route::get('/events/upcoming', 'EventController@upcoming')->name('events.upcoming');
    Route::get('/events/past', 'EventController@past')->name('events.past');
});