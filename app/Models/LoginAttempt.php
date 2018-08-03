<?php

namespace App\Models;

use App\Models\Traits\Shortcode;
use App\Models\Traits\Slug;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LoginAttempt
 *
 * @property int $user_id
 * @property string $status
 * @property \Carbon\Carbon $login_at
 * @property string|null $ip_address
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginAttempt whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginAttempt whereLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginAttempt whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\LoginAttempt whereUserId($value)
 * @mixin \Eloquent
 */
class LoginAttempt extends Model
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

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ip_address',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'login_at',
    ];

    public function isSuccess()
    {
        return $this->status == 'success';
    }

    public function isFailure()
    {
        return !$this->isSuccess();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
