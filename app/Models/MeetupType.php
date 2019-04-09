<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetupType extends Model
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
        'external_id', 'title', 'description', 'color', 'parent_id',
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
        //
    ];

    public function meetups()
    {
        return $this->hasMany(Meetup::class);
    }
}
