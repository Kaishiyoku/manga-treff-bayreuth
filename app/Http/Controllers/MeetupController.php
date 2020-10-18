<?php

namespace App\Http\Controllers;

use App\Models\Meetup;
use App\Models\MeetupUserRegistration;
use Illuminate\Http\Request;

class MeetupController extends Controller
{
    public function upcoming()
    {
        $upcomingMeetups = Meetup::upcoming()->orderBy('date_start', 'asc')->get();
        $firstUpcomingMeetup = $upcomingMeetups->first();
        $upcomingMeetups = $upcomingMeetups->skip(1);

        return view('meetup.upcoming', compact('firstUpcomingMeetup', 'upcomingMeetups'));
    }

    public function past()
    {
        $pastMeetups = Meetup::past()->orderBy('date_start', 'desc')->get();

        return view('meetup.past', compact('pastMeetups'));
    }

    public function show(Meetup $meetup)
    {
        $meetupUserRegistrations = $meetup->userRegistrations()->orderBy('created_at', 'asc')->get();

        $ownMeetupRegistration = $meetupUserRegistrations->filter(function (MeetupUserRegistration $meetupUserRegistration) {
            return $meetupUserRegistration->user_id === auth()->user()->id;
        })->first();

        return view('meetup.show', compact('meetup', 'meetupUserRegistrations', 'ownMeetupRegistration'));
    }

    public function toggleRegistration(Request $request, Meetup $meetup)
    {
        if ($meetup->isPast()) {
            return abort(422);
        }

        $data = $request->validate($this->getRegistrationRules());

        $meetupRegistration = auth()->user()->meetupRegistrations()->whereMeetupId($meetup->id)->first();

        if ($meetupRegistration) {
            $meetupRegistration->delete();

            flash()->success(__('meetup.show.registration.create.unregister_success'));
        } else {
            $meetupRegistration = new MeetupUserRegistration(['comment' => $data['comment']]);
            $meetupRegistration->meetup_id = $meetup->id;

            auth()->user()->meetupRegistrations()->save($meetupRegistration);

            flash()->success(__('meetup.show.registration.create.register_success'));
        }

        return redirect()->route('meetups.show', $meetup);
    }

    public function updateRegistration(Request $request, MeetupUserRegistration $meetupUserRegistration)
    {
        if ($meetupUserRegistration->meetup->isPast()) {
            return abort(422);
        }

        $data = $request->validate($this->getRegistrationRules());

        $meetupUserRegistration->fill($data);

        $meetupUserRegistration->save();

        flash()->success(__('meetup.show.registration.edit.success'));

        return redirect()->route('meetups.show', $meetupUserRegistration->meetup);
    }

    public function getRegistrationRules()
    {
        return [
            'comment' => ['string', 'nullable', 'max:1000'],
        ];
    }
}
