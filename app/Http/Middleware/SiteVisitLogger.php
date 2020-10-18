<?php

namespace App\Http\Middleware;

use App\Models\SiteVisit;
use Closure;
use Illuminate\Http\Request;

class SiteVisitLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        SiteVisit::firstOrCreate([
            'ip' => $request->ip(),
            'visited_at' => now()->toDateString(),
        ]);

        return $next($request);
    }
}
