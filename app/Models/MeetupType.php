<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * App\Models\MeetupType
 *
 * @property int $external_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $description
 * @property string $color
 * @property int $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meetup[] $meetups
 * @property-read int|null $meetups_count
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupType whereSlug($value)
 * @mixin \Eloquent
 */
class MeetupType extends Model
{
    use HasSlug;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'external_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
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

    public function meetups()
    {
        return $this->hasMany(Meetup::class);
    }
}
