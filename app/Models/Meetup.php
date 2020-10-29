<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\Meetup
 *
 * @property int|null $external_id
 * @property string $address
 * @property string $name
 * @property string|null $slug
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property string $zip
 * @property string $city
 * @property string $state
 * @property int $contact_id
 * @property string $attendees
 * @property string $intro
 * @property string|null $main_image
 * @property string|null $logo_image
 * @property string $country
 * @property float|null $geo_lat
 * @property float|null $geo_long
 * @property int|null $geo_zoom
 * @property int|null $geo_type
 * @property int $meetup_type_external_id
 * @property string $description
 * @property int $is_manually_added
 * @property int $id
 * @property array|null $animexx_data
 * @property-read \App\Models\MeetupType $meetupType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MeetupUserRegistration[] $userRegistrations
 * @property-read int|null $user_registrations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup past()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereAnimexxData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereAttendees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereGeoLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereGeoLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereGeoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereGeoZoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereIsManuallyAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereLogoImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereMeetupTypeExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereZip($value)
 * @mixin \Eloquent
 */
class Meetup extends Model
{
    use HasSlug;

    protected $primaryKey = 'id';

    public $incrementing = false;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'external_id',
        'address',
        'category',
        'size',
        'description',
        'name',
        'date_start',
        'date_end',
        'zip',
        'city',
        'state',
        'contact_id',
        'attendees',
        'intro',
        'main_image',
        'logo_image',
        'country',
        'geo_lat',
        'geo_long',
        'geo_zoom',
        'geo_type',
        'meetup_type_external_id',
        'attendees',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'animexx_data' => 'array',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['id', 'name'])
            ->saveSlugsTo('slug');
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date_start', '>=', today()->startOfDay());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePast($query)
    {
        return $query->where('date_end', '<', now()->endOfDay());
    }

    public function isUpcoming()
    {
        return $this->date_start >= today()->startOfDay();
    }

    public function isPast()
    {
        return $this->date_end < now()->endOfDay();
    }

    public function canUsersRegister()
    {
        return $this->date_start >= now();
    }

    public function getUrl()
    {
        if ($this->is_manually_added) {
            return null;
        }

        return config('site.animexx_event_base_url') . '/' . $this->external_id . '/' . $this->slug;
    }

    public function getMeetupLocation()
    {
        return $this->country . ', ' . $this->state . ', ' . $this->zip . ' ' . $this->city . ', ' . $this->address;
    }

    public function meetupType()
    {
        return $this->belongsTo(MeetupType::class);
    }

    public function userRegistrations()
    {
        return $this->hasMany(MeetupUserRegistration::class);
    }
}
