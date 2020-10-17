<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VisitorNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VisitorNoticeController extends Controller
{
    /**
     * @var string
     */
    private $redirectRoute = 'admin.visitor_notices.index';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitorNotices = VisitorNotice::orderBy('starting_at')->orderBy('ending_at');

        return view('admin.visitor_notice.index', compact('visitorNotices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $visitorNotice = new VisitorNotice();

        return view('admin.visitor_notice.create', compact('visitorNotice'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->getRules());

        $visitorNotice = new VisitorNotice($data);
        $visitorNotice->save();

        flash()->success(__('visitor_notice.admin.create.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitorNotice  $visitorNotice
     * @return \Illuminate\Http\Response
     */
    public function show(VisitorNotice $visitorNotice)
    {
        return view('admin.visitor_notice.show', compact('visitorNotice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitorNotice  $visitorNotice
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitorNotice $visitorNotice)
    {
        return view('admin.visitor_notice.edit', compact('visitorNotice'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VisitorNotice  $visitorNotice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VisitorNotice $visitorNotice)
    {
        $data = $request->validate($this->getRules($visitorNotice));

        $visitorNotice->fill($data);

        $visitorNotice->save();

        flash()->success(__('visitor_notice.admin.edit.success'));

        return redirect()->route($this->redirectRoute);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitorNotice  $visitorNotice
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitorNotice $visitorNotice)
    {
        $visitorNotice->delete();

        flash()->success(__('visitor_notice.admin.destroy.success'));

        return redirect()->route($this->redirectRoute);
    }

    private function getRules(?VisitorNotice $visitorNotice = null)
    {
        return [
            'title' => ['nullable', 'string'],
            'content' => ['required', 'string', 'max:5000'],
            'starting_at' => ['required', 'date', 'after_or_equal:' . ($visitorNotice ? $visitorNotice->starting_at->toDateString() : 'today')],
            'ending_at' => ['required', 'date', 'after_or_equal:starting_at'],
        ];
    }
}
