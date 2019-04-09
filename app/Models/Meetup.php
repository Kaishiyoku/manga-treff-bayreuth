<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Meetup extends Model
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
        'meetup_type_external_id',
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
