<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteVisit;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $unverifiedUsers = User::unverified()->orderBy('created_at')->get();

        $siteVisits = SiteVisit::orderBy('visited_at', 'desc')->get()->groupBy(function (SiteVisit $siteVisit) {
            return $siteVisit->visited_at->toDateString();
        });

        return view('admin.home.index', compact('unverifiedUsers', 'siteVisits'));
    }
}
