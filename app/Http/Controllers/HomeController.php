<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $nextUpcomingEvent = Event::where('date', '>=', Carbon::now())->orderBy('date')->first();

        return view('home.index', compact('futureEvents', 'pastEvents', 'nextUpcomingEvent'));
    }
}
