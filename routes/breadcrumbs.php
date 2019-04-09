<?php

// Home
Breadcrumbs::for('home.index', function ($trail) {
    $trail->push('Home', route('home.index'));
});

// Upcoming meetups
Breadcrumbs::for('meetups.upcoming', function ($trail) {
    $trail->push(__('home.index.meetups.upcoming'), route('meetups.upcoming'));
});

// Past meetups
Breadcrumbs::for('meetups.past', function ($trail) {
    $trail->push(__('home.index.meetups.past'), route('meetups.past'));
});

// Upcoming meetups > [Meetup]
Breadcrumbs::for('meetups.show_upcoming', function ($trail, \App\Models\Meetup $meetup) {
    $trail->parent('meetups.upcoming');
    $trail->push($meetup->date_start->format(__('date.datetime')), route('meetups.show', $meetup));
});

// Past meetups > [Meetup]
Breadcrumbs::for('meetups.show_past', function ($trail, \App\Models\Meetup $meetup) {
    $trail->parent('meetups.past');
    $trail->push($meetup->date_start->format(__('date.datetime')), route('meetups.show', $meetup));
});