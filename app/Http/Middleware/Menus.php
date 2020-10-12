<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Menus
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \LaravelMenu::register()
            ->addClassNames('mr-auto')
            ->link('home.index', '<i class="fas fa-home"></i> ' . __('common.home'), true)
            ->link('meetups.upcoming,meetups.past,meetups.show', '<i class="fas fa-calendar"></i> ' . __('common.meetups'))
            ->link('home.discord', '<i class="fab fa-discord"></i> ' . __('common.discord.title'), true);

        \LaravelMenu::register('auth_public')
            ->link('login', '<i class="fas fa-sign-in-alt"></i> ' . __('common.login'))
            ->link('register', '<i class="fas fa-user-plus"></i> ' . __('common.register'));

        \LaravelMenu::register('auth_logged_in')
            ->linkIf($this->isLoggedIn(), 'profile.index,profile.login_attempts,profile.active_sessions', '<i class="fas fa-user"></i> <span class="sm:hidden">' . __('common.profile') . '</span>')
            ->linkIf($this->isAdmin(), 'admin.home.index', '<i class="fas fa-tools"></i> <span class="sm:hidden">' . __('common.administration') . '</span>');

        \LaravelMenu::register('admin')
            ->addClassNames('mr-auto')
            ->link('admin.users.index,admin.users.create,admin.users.edit', '<i class="fas fa-users"></i> ' . __('common.users'), true)
            ->link('admin.meetups.index,admin.meetups.edit', '<i class="fas fa-calendar"></i> ' . __('common.meetups'), true);

        return $next($request);
    }

    /**
     * @return bool
     */
    private function isLoggedIn()
    {
        return $this->auth->check();
    }

    /**
     * @return bool
     */
    private function isAdmin()
    {
        return $this->isLoggedIn() && $this->auth->user()->is_admin;
    }
}
