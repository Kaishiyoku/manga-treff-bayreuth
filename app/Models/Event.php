<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property int|null $external_id
 * @property string $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $date
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDate($value)
 * @property string $address
 * @property string $category
 * @property string $size
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @property string $name
 * @property string $date_start
 * @property string $date_end
 * @property string $zip
 * @property string $city
 * @property string $state
 * @property int $contact_id
 * @property string $attendees
 * @property string $intro
 * @property string $main_image
 * @property string $logo_image
 * @property string $country
 * @property float $geo_lat
 * @property float $geo_long
 * @property int $geo_zoom
 * @property int $geo_type
 * @property int $event_type_external_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereAttendees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereEventTypeExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereGeoLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereGeoLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereGeoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereGeoZoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereIntro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLogoImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereZip($value)
 */
class Event extends Model
{
    protected $primaryKey = 'external_id';

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
        'event_type_external_id',
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

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function getUrl()
    {
        return env('ANIMEXX_EVENT_BASE_URL') . '/' . $this->external_id;
    }
}
