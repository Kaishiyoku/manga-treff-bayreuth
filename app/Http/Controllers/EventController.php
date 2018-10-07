<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;

class EventController extends Controller
{
    public function upcoming()
    {
        $upcomingEvents = Event::where('date', '>=', Carbon::today())->orderBy('external_id');

        return view('event.upcoming', compact('upcomingEvents'));
    }

    public function past()
    {
        $pastEvents = Event::where('date', '<', Carbon::now())->orderBy('external_id', 'desc');

        return view('event.past', compact('pastEvents'));
    }
}
