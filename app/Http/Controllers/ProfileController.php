<?php

namespace App\Http\Controllers;

use App\Mail\EmailChanged;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;

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

    /**
     * @return \Illuminate\Http\Response
     */
    public function editEmail()
    {
        return view('profile.edit_email');
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(Request $request)
    {
        $rules = [
            'current_email' => ['required', 'email', 'max:255', Rule::exists('users', 'email')->where(function ($query) {
                $query->where('id', auth()->user()->id);
            })],
            'new_email' => ['required', 'email', 'max:255', 'confirmed', 'unique:users,email']
        ];

        $request->validate($rules);

        $user = auth()->user();
        $user->new_email = $request->get('new_email');
        $user->new_email_token = Str::random(60);
        $user->save();

        Mail::to($user->new_email)->send(new EmailChanged($user->new_email, $user->new_email_token));

        flash()->success(__('profile.edit_email.success'));

        return redirect()->route('profile.index');
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function confirmNewEmail(Request $request, $token)
    {
        $user = auth()->user();

        // if token is invalid return with error
        if ($user->new_email_token != $token) {
            flash()->error(__('profile.confirm_new_email.invalid_token'));

            return redirect()->back();
        }

        // set new email and reset temp fields
        $user->email = $user->new_email;
        $user->new_email = null;
        $user->new_email_token = null;
        $user->save();

        // logout user so he has to login again with the new set mail adresse
        $this->logoutUser($request);

        flash()->success(__('profile.confirm_new_email.success'));

        return redirect()->route('login');
    }

    public function showDeleteAccountConfirmation()
    {
        return view('profile.delete_account_confirmation');
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAccount(Request $request)
    {
        $user = auth()->user();

        $user->email_verified_at = null;
        $user->save();

        $user->databaseSessions()->delete();
        $user->delete();

        $this->logoutUser($request);

        flash()->success(__('profile.delete_account.success'));

        return redirect()->to(RouteServiceProvider::HOME);
    }

    /**
     * @param Request $request
     */
    private function logoutUser(Request $request)
    {
        auth()->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
    }
}
