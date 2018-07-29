<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $futureEvents = Event::where('date', '>=', Carbon::now())->orderBy('external_id', 'desc');
        $pastEvents = Event::where('date', '<', Carbon::now())->orderBy('external_id', 'desc');

        return view('home.index', compact('futureEvents', 'pastEvents'));
    }
}
