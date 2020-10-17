<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SiteVisit
 *
 * @property int $id
 * @property string $ip
 * @property \Illuminate\Support\Carbon $visited_at
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteVisit whereVisitedAt($value)
 * @mixin \Eloquent
 */
class SiteVisit extends Model
{
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
        'ip',
        'visited_at',
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
        'visited_at' => 'date',
    ];
}
