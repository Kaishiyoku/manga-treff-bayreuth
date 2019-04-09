<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Kaishiyoku\Menu\Config\Config;
use Kaishiyoku\Menu\Facades\Menu;

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
        Menu::setConfig(Config::forBootstrap4());

        Menu::registerDefault([
            Menu::linkRoute('home.index', '<i class="fas fa-home"></i> ' . __('common.home')),
            Menu::linkRoute('events.upcoming', '<i class="fas fa-calendar"></i> ' . __('common.events'), [], [], ['events.past', 'events.show']),
            Menu::linkRoute('home.discord', '<i class="fab fa-discord"></i> ' . __('common.discord.title')),
        ], ['class' => 'navbar-nav mr-auto']);

        Menu::register('auth_public', [
            Menu::linkRoute('login', '<i class="fas fa-sign-in-alt"></i> ' . __('common.login')),
            Menu::linkRoute('register', '<i class="fas fa-user-plus"></i> ' . __('common.register')),
        ], ['class' => 'navbar-nav']);

        Menu::register('auth_logged_in', [
            Menu::linkRoute('profile.index', '<i class="fas fa-user"></i> ' . __('common.profile'), [], [], ['profile.login_attempts', 'profile.active_sessions'], $this->auth->check()),
            Menu::linkRoute('admin.home.index', '<i class="fas fa-unlock"></i> ' . __('common.administration'), [], [], [], $this->isAdmin())
        ], ['class' => 'navbar-nav']);

        Menu::register('admin', [
            Menu::linkRoute('admin.users.index', '<i class="fas fa-users"></i> ' . __('common.users'), [], [], ['admin.users.create', 'admin.users.edit']),
            Menu::linkRoute('admin.events.index', '<i class="fas fa-calendar"></i> ' . __('common.events'), [], [], ['admin.events.edit']),
        ], ['class' => 'navbar-nav mr-auto']);

        return $next($request);
    }

    /**
     * @return bool
     */
    private function isAdmin()
    {
        return $this->auth->check() && $this->auth->user()->is_admin;
    }
}