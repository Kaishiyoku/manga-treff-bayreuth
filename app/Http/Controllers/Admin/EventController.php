<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'admin.events.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('date', 'desc');

        return view('admin.event.index', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate($this->getValidationRules());

        $event->fill($request->only($this->getFillableFields()));
        $event->date = Carbon::createFromFormat(__('date.short'), $request->get('date'));
        $event->save();

        flash()->success(__('event.admin.edit.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Event $event)
    {
        $event->delete();

        flash()->success(__('event.admin.destroy.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * @return array
     */
    private function getFillableFields()
    {
        return [

        ];
    }

    /**
     * @return array
     */
    protected function getValidationRules()
    {
        return [
            'date' => ['required', 'date_format:' . __('date.short')],
        ];
    }
}