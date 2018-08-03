<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        return view('profile.index', compact('user'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function loginAttempts()
    {
        $now = Carbon::now()->setTime(23, 59, 59);
        $from = Carbon::now()->subDays(14)->setTime(0, 0, 0);

        $loginAttempts = auth()->user()->loginAttempts()->whereBetween('login_at', [$from->toDateTimeString(), $now->toDateTimeString()])->get();

        return view('profile.login_attempts', compact('loginAttempts'));
    }
}
