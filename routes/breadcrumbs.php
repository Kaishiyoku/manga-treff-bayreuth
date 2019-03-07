<?php

// Home
Breadcrumbs::for('home.index', function ($trail) {
    $trail->push('Home', route('home.index'));
});

// Upcoming events
Breadcrumbs::for('events.upcoming', function ($trail) {
    $trail->push(__('home.index.events.upcoming'), route('events.upcoming'));
});

// Past events
Breadcrumbs::for('events.past', function ($trail) {
    $trail->push(__('home.index.events.past'), route('events.past'));
});

// Upcoming events > [Event]
Breadcrumbs::for('events.show_upcoming', function ($trail, \App\Models\Event $event) {
    $trail->parent('events.upcoming');
    $trail->push($event->date_start->format(__('date.datetime')), route('events.show', $event));
});

// Past events > [Event]
Breadcrumbs::for('events.show_past', function ($trail, \App\Models\Event $event) {
    $trail->parent('events.past');
    $trail->push($event->date_start->format(__('date.datetime')), route('events.show', $event));
});