<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageClick;
use App\Models\SiteVisit;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $groupByVisitedAtDateFn = function ($model) {
            return $model->visited_at->toDateString();
        };

        $unverifiedUsers = User::unverified()->orderBy('created_at')->get();

        $siteVisits = SiteVisit::whereDate('visited_at', '>=', today()->subMonth()->toDateString())->orderBy('visited_at', 'desc')->get()->groupBy($groupByVisitedAtDateFn);

        $pageClicks = PageClick::whereDate('visited_at', '>=', today()->subMonth())
            ->orderBy('visited_at', 'desc')
            ->get()
            ->groupBy($groupByVisitedAtDateFn);

        return view('admin.home.index', compact('unverifiedUsers', 'siteVisits', 'pageClicks'));
    }
}
