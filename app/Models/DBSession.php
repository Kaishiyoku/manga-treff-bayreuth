<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DBSession
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string $payload
 * @property int $last_activity
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DBSession whereUserId($value)
 * @mixin \Eloquent
 */
class DBSession extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sessions';

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

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'ip_address', 'user_agent', 'payload', 'last_activity'
    ];
}
