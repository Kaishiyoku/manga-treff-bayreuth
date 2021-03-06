<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meetup;
use App\Models\MeetupType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MeetupController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'admin.meetups.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upcomingMeetups = Meetup::upcoming()->orderBy('date_start', 'asc');
        $pastMeetups = Meetup::past()->orderBy('date_start', 'desc');

        return view('admin.meetup.index', compact('upcomingMeetups', 'pastMeetups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meetup = new Meetup();
        $meetup->is_manually_added = true;

        $meetup->date_start = now()->addHour()->setMinutes(0);
        $meetup->date_end = $meetup->date_start->addHour();

        $meetupTypes = $this->getMeetupTypes();

        return view('admin.meetup.create', compact('meetup', 'meetupTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());

        $meetup = new Meetup();
        $meetup->is_manually_added = true;
        $meetup->contact_id = config('site.default_contact_id');

        $meetup->fill($request->only($this->getFillableFields()));

        $meetup->date_start = Carbon::parse($request->get('date_start') . ' ' . $request->get('time_start'));
        $meetup->date_end = Carbon::parse($request->get('date_end') . ' ' . $request->get('time_end'));
        $meetup->save();

        flash(__('meetup.admin.create.success'))->success();

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Meetup $meetup
     * @return \Illuminate\Http\Response
     */
    public function edit(Meetup $meetup)
    {
        $meetupTypes = $this->getMeetupTypes();

        return view('admin.meetup.edit', compact('meetup', 'meetupTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Meetup $meetup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meetup $meetup)
    {
        $request->validate($this->getValidationRules());

        $meetup->fill($request->only($this->getFillableFields()));
        $meetup->date_start = Carbon::parse($request->get('date_start') . ' ' . $request->get('time_start'));
        $meetup->date_end = Carbon::parse($request->get('date_end') . ' ' . $request->get('time_end'));
        $meetup->save();

        flash()->success(__('meetup.admin.edit.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meetup $meetup
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Meetup $meetup)
    {
        $meetup->delete();

        flash()->success(__('meetup.admin.destroy.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * @return array
     */
    private function getFillableFields()
    {
        return [
            'country',
            'state',
            'address',
            'zip',
            'city',
            'intro',
            'description',
            'contact_id',
            'name',
            'attendees',
            'meetup_type_external_id',
        ];
    }

    /**
     * @return array
     */
    protected function getValidationRules()
    {
        return [
            'name' => ['required', 'string'],
            'date_start' => ['required', 'date_format:Y-m-d'],
            'date_end' => ['required', 'date_format:Y-m-d'],
            'time_start' => ['required', 'date_format:H:i:s'],
            'time_end' => ['required', 'date_format:H:i:s'],
            'country' => 'required',
            'state' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'intro' => 'required',
            'description' => 'required',
            'attendees' => 'required',
            'meetup_type_external_id' => ['required', Rule::in(MeetupType::pluck('external_id'))],
        ];
    }

    private function getMeetupTypes()
    {
        return MeetupType::pluck('name', 'external_id');
    }
}
