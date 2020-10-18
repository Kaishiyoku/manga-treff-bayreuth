<?php

namespace App\Http\Middleware;

use App\Models\PageClick;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageClickLogger
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentRoute = $request->route()->getName();

        if ($this->isTrackableRoute($currentRoute)) {
            PageClick::firstOrCreate([
                'ip' => $request->ip(),
                'user_id' => optional(auth()->user())->id,
                'route' => $currentRoute,
                'uri' => Str::of($request->path())->trim('/')->prepend('/'),
                'visited_at' => now()->toDateString(),
            ]);
        }

        return $next($request);
    }

    private function isTrackableRoute($currentPath)
    {
        $trackingRoutes = collect(config('site.page_click_tracking_routes'));

        return $trackingRoutes
            ->filter(function ($trackingPath) use ($currentPath) {
                return $trackingPath === $currentPath;
            })
            ->isNotEmpty();
    }
}
