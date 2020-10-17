<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MeetupType
 *
 * @property int $external_id
 * @property string $title
 * @property string|null $description
 * @property string $color
 * @property int $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meetup[] $meetups
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MeetupType whereTitle($value)
 * @mixin \Eloquent
 * @property-read int|null $meetups_count
 */
class MeetupType extends Model
{
    protected $primaryKey = 'external_id';

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
