<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSent;
use App\Models\Meetup;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $discordItem = fetchDiscordWidgetApiContent();
        $getDiscordMembersInChannel = function ($discordItem, $channelId) {
            return Arr::where($discordItem->members, function ($member) use ($channelId) {
                return property_exists($member, 'channel_id') && $member->channel_id == $channelId;
            });
        };

        $nextUpcomingMeetup = Meetup::where('is_manually_added', false)->where('date_start', '>=', Carbon::today())->orderBy('date_start')->first();

        return view('home.index', compact('nextUpcomingMeetup', 'discordItem', 'getDiscordMembersInChannel'));
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
            'email' => 'required|email',
            'fullname' => 'required',
            'content' => 'required'
        ]);

        Mail::to(config('site.app_admin_email'))->send(new ContactFormSent($validated['email'], $validated['fullname'], $validated['content']));

        flash()->success(__('home.contact.success'));

        return redirect('/');
    }

    public function discord()
    {
        $discordItem = fetchDiscordWidgetApiContent();

        return redirect($discordItem->instant_invite);
    }
}
