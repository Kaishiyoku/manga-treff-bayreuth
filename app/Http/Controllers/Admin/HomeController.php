<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteVisit;

class HomeController extends Controller
{
    public function index()
    {
        $siteVisits = SiteVisit::orderBy('visited_at', 'desc')->get()->groupBy(function (SiteVisit $siteVisit) {
            return $siteVisit->visited_at->toDateString();
        });

        return view('admin.home.index', compact('siteVisits'));
    }
}
