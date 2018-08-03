<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile.index', compact('user'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }
}
