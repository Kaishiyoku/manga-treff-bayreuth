<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PageClick
 *
 * @property int $id
 * @property string $ip
 * @property int|null $user_id
 * @property string $uri
 * @property \Illuminate\Support\Carbon $visited_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageClick whereVisitedAt($value)
 * @mixin \Eloquent
 */
class PageClick extends Model
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
        'user_id',
        'route',
        'uri',
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
        'visited_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
