<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meetup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

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
        $meetups = Meetup::orderBy('date_start', 'desc');

        return view('admin.meetup.index', compact('meetups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Meetup $meetup
     * @return \Illuminate\Http\Response
     */
    public function edit(Meetup $meetup)
    {
        return view('admin.meetup.edit', compact('meetup'));
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
        $meetup->date_start = Carbon::createFromFormat(__('date.datetime'), $request->get('date_start') . ' ' . $request->get('time_start'));
        $meetup->date_end = Carbon::createFromFormat(__('date.datetime'), $request->get('date_end') . ' ' . $request->get('time_end'));
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
        ];
    }

    /**
     * @return array
     */
    protected function getValidationRules()
    {
        return [
            'date_start' => ['required', 'date_format:' . __('date.short')],
            'date_end' => ['required', 'date_format:' . __('date.short')],
            'time_start' => ['required', 'date_format:' . __('date.time')],
            'time_end' => ['required', 'date_format:' . __('date.time')],
            'country' => 'required',
            'state' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'intro' => 'required',
            'description' => 'required',
        ];
    }
}