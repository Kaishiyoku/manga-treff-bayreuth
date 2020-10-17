<?php

namespace App\Http\Controllers;

use App\Models\Meetup;
use Illuminate\Support\Carbon;

class MeetupController extends Controller
{
    public function upcoming()
    {
        $upcomingMeetups = Meetup::upcoming()->orderBy('date_start', 'asc')->get();
        $firstUpcomingMeetup = $upcomingMeetups->first();
        $upcomingMeetups = $upcomingMeetups->skip(1);

        return view('meetup.upcoming', compact('firstUpcomingMeetup', 'upcomingMeetups'));
    }

    public function past()
    {
        $pastMeetups = Meetup::past()->orderBy('date_start', 'desc')->get();

        return view('meetup.past', compact('pastMeetups'));
    }

    public function show(Meetup $meetup)
    {
        return view('meetup.show', compact('meetup'));
    }
}
