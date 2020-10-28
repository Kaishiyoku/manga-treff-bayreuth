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
            ->link('home.index', '<i class="fas fa-home"></i> <span class="lg:hidden xl:inline-block">' . __('common.home') . '</span>', true)
            ->link('meetups.upcoming,meetups.past,meetups.show', '<i class="fas fa-calendar"></i> ' . __('common.meetups'))
            ->link('home.about_us', '<i class="fas fa-info-circle"></i> ' . __('common.about_us'), true)
            ->link('users.members', '<i class="fas fa-user-friends"></i> ' . __('user.member.title'), true);

        \LaravelMenu::register('auth_public')
            ->link('login', '<i class="fas fa-sign-in-alt"></i> ' . __('common.login'))
            ->link('register', '<i class="fas fa-user-plus"></i> ' . __('common.register'));

        \LaravelMenu::register('auth_logged_in')
            ->linkIf($this->isLoggedIn(), 'profile.index,profile.login_attempts,profile.active_sessions', '<i class="fas fa-user"></i> <span class="lg:hidden xl:inline-block">' . __('common.profile') . '</span>')
            ->linkIf($this->isAdmin(), 'admin.home.index', '<i class="fas fa-tools"></i> <span class="sm:hidden md:inline-block">' . __('common.administration') . '</span>');

        \LaravelMenu::register('admin')
            ->addClassNames('nav-dark')
            ->link('admin.users.index,admin.users.create,admin.users.edit', '<i class="fas fa-users"></i> ' . __('common.users'), true)
            ->link('admin.meetups.index,admin.meetups.create,admin.meetups.edit', '<i class="fas fa-calendar"></i> ' . __('common.meetups'), true)
            ->link('admin.visitor_notices.index,admin.visitor_notices.create,admin.visitor_notices.edit', '<i class="fas fa-info-circle"></i> ' . __('common.visitor_notices'), true)
            ->link('admin.settings.edit', '<i class="fas fa-cogs"></i> ' . __('common.settings'), true);

        return $next($request);
    }
}
