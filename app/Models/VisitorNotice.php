<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\VisitorNotice
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorNotice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorNotice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VisitorNotice query()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $title
 * @property string $content
 * @property \Illuminate\Support\Carbon $starting_at
 * @property \Illuminate\Support\Carbon $ending_at
 * @method static Builder|VisitorNotice today()
 * @method static Builder|VisitorNotice whereContent($value)
 * @method static Builder|VisitorNotice whereEndingAt($value)
 * @method static Builder|VisitorNotice whereId($value)
 * @method static Builder|VisitorNotice whereStartingAt($value)
 * @method static Builder|VisitorNotice whereTitle($value)
 */
class VisitorNotice extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'starting_at',
        'ending_at',
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
        'starting_at' => 'date',
        'ending_at' => 'date',
    ];

    /**
     * Scope a query to only include today's visitor notices.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeToday(Builder $query)
    {
        return $query
            ->whereDate('starting_at', '<=', now()->toDateString())
            ->whereDate('ending_at', '>=', now()->toDateString());
    }
}
