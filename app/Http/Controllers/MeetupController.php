<?php

namespace App\Http\Controllers;

use App\Models\Meetup;
use Illuminate\Support\Carbon;

class MeetupController extends Controller
{
    public function upcoming()
    {
        $upcomingMeetups = Meetup::upcoming()->orderBy('external_id');

        return view('meetup.upcoming', compact('upcomingMeetups'));
    }

    public function past()
    {
        $pastMeetups = Meetup::past()->orderBy('external_id', 'desc');

        return view('meetup.past', compact('pastMeetups'));
    }

    public function show(Meetup $meetup)
    {
        return view('meetup.show', compact('meetup'));
    }
}
