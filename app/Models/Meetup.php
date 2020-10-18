<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Meetup
 *
 * @property int|null $external_id
 * @property string $address
 * @property string $name
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
 * @property-read \App\Models\MeetupType $meetupType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MeetupUserRegistration[] $userRegistrations
 * @property-read int|null $user_registrations_count
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup past()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereAddress($value)
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
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meetup whereZip($value)
 * @mixin \Eloquent
 */
class Meetup extends Model
{
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

    protected $dates = [
        'date_start',
        'date_end'
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query->where('date_start', '>=', Carbon::today()->startOfDay());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePast($query)
    {
        return $query->where('date_end', '<', Carbon::now()->endOfDay());
    }

    public function isUpcoming()
    {
        return $this->date_start >= Carbon::today()->startOfDay();
    }

    public function isPast()
    {
        return $this->date_end < Carbon::now()->endOfDay();
    }

    public function getUrl()
    {
        if ($this->is_manually_added) {
            return null;
        }

        return config('site.animexx_event_base_url') . '/' . $this->external_id;
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
