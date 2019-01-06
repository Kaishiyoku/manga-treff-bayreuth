<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSent;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $nextUpcomingEvent = Event::where('date_start', '>=', Carbon::today())->orderBy('date_start')->first();

        return view('home.index', compact('futureEvents', 'pastEvents', 'nextUpcomingEvent'));
    }

    /**
     * Show imprint.
     *
     * @return \Illuminate\Http\Response
     */
    public function imprint()
    {
        return view('home.imprint');
    }

    /**
     * Show private policy.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicy()
    {
        return view('home.privacy_policy');
    }

    /**
     * Show contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showContactForm()
    {
        return view('home.contact');
    }

    /**
     * Send the contact form.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendContactForm(Request $request)
    {
        $validated = $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'email' => 'required|email',
            'fullname' => 'required',
            'content' => 'required'
        ]);

        Mail::to(env('APP_ADMIN_EMAIL'))->send(new ContactFormSent($validated['email'], $validated['fullname'], $validated['content']));

        flash()->success(__('home.contact.success'));

        return redirect('/');
    }
}
