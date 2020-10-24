<?php

namespace App\Models;

use App\Models\Traits\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $about_me
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $is_member
 * @property bool $is_admin
 * @property string|null $new_email
 * @property string|null $new_email_token
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\DBSession[] $databaseSessions
 * @property-read int|null $database_sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LoginAttempt[] $loginAttempts
 * @property-read int|null $login_attempts_count
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MeetupUserRegistration[] $meetupRegistrations
 * @property-read int|null $meetup_registrations_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|User members()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User unverified()
 * @method static Builder|User whereAboutMe($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereIsAdmin($value)
 * @method static Builder|User whereIsMember($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNewEmail($value)
 * @method static Builder|User whereNewEmailToken($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSlug($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use Sluggable, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'about_me',
        'is_member',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
        'is_member' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include unverified users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUnverified(Builder $query)
    {
        return $query->whereNull('email_verified_at');
    }

    /**
     * Scope a query to only include member users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMembers(Builder $query)
    {
        return $query->whereIsMember(true);
    }

    public function loginAttempts()
    {
        return $this->hasMany(LoginAttempt::class)->orderBy('login_at', 'desc');
    }

    public function databaseSessions()
    {
        return $this->hasMany(DBSession::class);
    }

    public function meetupRegistrations()
    {
        return $this->hasMany(MeetupUserRegistration::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb-100')
            ->crop('crop-center', 100, 100)
            ->optimize();

        $this->addMediaConversion('thumb-50')
            ->crop('crop-center', 50, 50)
            ->optimize();

        $this->addMediaConversion('thumb-30')
            ->crop('crop-center', 30, 30)
            ->optimize();
    }

    public function getLatestAvatarUrl(string $conversionName = '')
    {
        return $this->getMedia()->last()->getUrl($conversionName);
    }
}
