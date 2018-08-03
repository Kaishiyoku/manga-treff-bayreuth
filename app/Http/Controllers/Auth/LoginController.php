<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginAttempt;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $loginAttempt = new LoginAttempt();
        $loginAttempt->ip_address = $request->ip();

        $user = User::whereEmail($request->get('email'))->first();

        if ($user != null) {
            $loginAttempt->user_id = $user->id;
        }

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->saveFailedLoginAttempt($loginAttempt, $user);

            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            $this->saveSuccessfulLoginAttempt($loginAttempt, $user);

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        if ($user != null) {
            $this->saveFailedLoginAttempt($loginAttempt, $user);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * @param LoginAttempt $loginAttempt
     * @param User $user
     * @param bool $isSuccess
     */
    private function saveLoginAttempt(LoginAttempt $loginAttempt, User $user, $isSuccess = false)
    {
        if ($user != null) {
            // store login attempt
            $loginAttempt->status = $isSuccess ? 'success' : 'failure';
            $loginAttempt->save();
        }
    }

    /**
     * @param LoginAttempt $loginAttempt
     * @param User $user
     */
    private function saveSuccessfulLoginAttempt(LoginAttempt $loginAttempt, User $user)
    {
        $this->saveLoginAttempt($loginAttempt, $user, true);
    }

    /**
     * @param LoginAttempt $loginAttempt
     * @param User $user
     */
    private function saveFailedLoginAttempt(LoginAttempt $loginAttempt, User $user)
    {
        $this->saveLoginAttempt($loginAttempt, $user, false);
    }
}
