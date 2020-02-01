<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Meetup
 *
 * @property int $external_id
 * @property string $address
 * @property string $name
 * @property \Illuminate\Support\Carbon $date_start
 * @property \Illuminate\Support\Carbon $date_end
 * @property string $zip
 * @property string $city
 * @property string $state
 * @property int $contact_id
 * @property string $attendees
 * @property string $intro
 * @property string|null $main_image
 * @property string|null $logo_image
 * @property string $country
 * @property float $geo_lat
 * @property float $geo_long
 * @property int $geo_zoom
 * @property int $geo_type
 * @property int $meetup_type_external_id
 * @property string $description
 * @property-read \App\Models\MeetupType $meetupType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup past()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup upcoming()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereAttendees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereGeoLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereGeoLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereGeoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereGeoZoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereLogoImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereMeetupTypeExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereZip($value)
 * @mixin \Eloquent
 * @property int $is_manually_added
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereIsManuallyAdded($value)
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meetup whereId($value)
 */
class Meetup extends Model
{
    protected $primaryKey = 'id';

    public $incrementing = false;

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

    public function meetupType()
    {
        return $this->belongsTo(MeetupType::class);
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
        return env('ANIMEXX_EVENT_BASE_URL') . '/' . $this->external_id;
    }

    public function getMeetupLocation()
    {
        return $this->country . ', ' . $this->state . ', ' . $this->zip . ' ' . $this->city . ', ' . $this->address;
    }
}
