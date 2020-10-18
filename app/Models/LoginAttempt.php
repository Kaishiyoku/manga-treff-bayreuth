<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LoginAttempt
 *
 * @property int $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon $login_at
 * @property string|null $ip_address
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt whereLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginAttempt whereUserId($value)
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
