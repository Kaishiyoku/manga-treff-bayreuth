<?php

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/events/upcoming', 'EventController@upcoming')->name('events.upcoming');
Route::get('/events/past', 'EventController@past')->name('events.past');