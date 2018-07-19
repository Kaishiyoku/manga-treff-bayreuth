<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('external_id', 'desc');

        return view('home.index', compact('events'));
    }
}
