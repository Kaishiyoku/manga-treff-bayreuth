<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EventType
 *
 * @property int $external_id
 * @property string $title
 * @property string|null $description
 * @property string $color
 * @property int $parent_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventType whereTitle($value)
 * @mixin \Eloquent
 */
class EventType extends Model
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

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
