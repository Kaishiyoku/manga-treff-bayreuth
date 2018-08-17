<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    /**
     * @return \Illuminate\Http\Response
     */
    public function activeSessions()
    {
        $databaseSessions = auth()->user()->databaseSessions()->get();

        return view('profile.active_sessions', ['databaseSessions' => $databaseSessions]);
    }

    /**
     * Destroy selected session.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroySession(Request $request)
    {
        $id = (int) $request->get('id');

        $databaseSession = auth()->user()->databaseSessions()->find($id);

        if ($databaseSession != null) {
            $databaseSession->delete();

            flash()->success(__('profile.destroy_session.success'));
        }

        return redirect()->route('profile.active_sessions');
    }
}
