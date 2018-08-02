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
            Menu::linkRoute('events.upcoming', __('common.events'), [], [], ['events.past']),
        ], ['class' => 'navbar-nav mr-auto']);

        Menu::register('auth_public', [
            Menu::linkRoute('login', __('common.login')),
            Menu::linkRoute('register', __('common.register')),
        ], ['class' => 'navbar-nav']);

        Menu::register('auth_logged_in', [
            Menu::linkRoute('admin.home.index', __('common.administration'), [], [], [], $this->isAdmin())
        ], ['class' => 'navbar-nav']);

        Menu::register('admin', [
            Menu::linkRoute('admin.users.index', __('common.users'), [], [], ['admin.users.create', 'admin.users.edit']),
            Menu::linkRoute('admin.events.index', __('common.events'), [], [], ['admin.events.edit']),
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