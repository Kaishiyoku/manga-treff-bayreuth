<?php

namespace App\Models;

use App\Models\Traits\Shortcode;
use App\Models\Traits\Slug;
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession whereLastActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession wherePayload($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DBSession query()
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
