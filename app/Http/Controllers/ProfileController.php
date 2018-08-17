<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function editPassword()
    {
        return view('profile.edit_password');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6'
        ]);

        if (!Hash::check($request->get('current_password'), $user->password)) {
            $validator->errors()->add('current_password', __('profile.edit_password.invalid_current_password'));

            throw new ValidationException($validator);
        }

        if ($validator->fails()) {
            return redirect()->route('profile.edit_password')
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        flash()->success(__('profile.edit_password.success'));

        return redirect()->route('profile.index');
    }
}
