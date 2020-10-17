<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\MeetupController as AdminMeetupController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetupController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/imprint', [HomeController::class, 'imprint'])->name('home.imprint');
Route::get('/privacy_policy', [HomeController::class, 'privacyPolicy'])->name('home.privacy_policy');
Route::get('/contact', [HomeController::class, 'showContactForm'])->name('home.show_contact_form');
Route::post('/contact', [HomeController::class, 'sendContactForm'])->name('home.send_contact_form');

Route::get('/meetups/upcoming', [MeetupController::class, 'upcoming'])->name('meetups.upcoming');
Route::get('/meetups/past', [MeetupController::class, 'past'])->name('meetups.past');
Route::resource('meetups', MeetupController::class)->only(['show']);

Route::redirect('/events/upcoming', '/meetups/upcoming', 302);
Route::redirect('/events/past', '/meetups/past', 302);

Auth::routes(['verify' => true]);

Route::get('/discord', [HomeController::class, 'discord'])->name('home.discord');

/////////////////////
// Logged on users //
/////////////////////
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/login_attempts', [ProfileController::class, 'loginAttempts'])->name('profile.login_attempts');
    Route::get('/profile/active_sessions', [ProfileController::class, 'activeSessions'])->name('profile.active_sessions');
    Route::delete('/profile/destroy_session', [ProfileController::class, 'destroySession'])->name('profile.destroy_session');
    Route::get('/profile/email/edit', [ProfileController::class, 'editEmail'])->name('profile.edit_email');
    Route::put('/profile/email/edit', [ProfileController::class, 'updateEmail'])->name('profile.update_email');
    Route::get('/profile/email/confirm/{token}', [ProfileController::class, 'confirmNewEmail'])->name('profile.confirm_new_email');
    Route::get('/profile/password/change', [ProfileController::class, 'editPassword'])->name('profile.edit_password');
    Route::put('/profile/password/change', [ProfileController::class, 'updatePassword'])->name('profile.update_password');

    ////////////////////
    // Administrators //
    ////////////////////
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('home.index');
        Route::resource('users', AdminUserController::class, ['except' => 'show']);
        Route::resource('meetups', AdminMeetupController::class, ['except' => ['show']]);
    });
});
