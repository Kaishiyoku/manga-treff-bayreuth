<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function upcoming()
    {
        $upcomingEvents = Event::upcoming()->orderBy('external_id');

        return view('event.upcoming', compact('upcomingEvents'));
    }

    public function past()
    {
        $pastEvents = Event::past()->orderBy('external_id', 'desc');

        return view('event.past', compact('pastEvents'));
    }

    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }
}
