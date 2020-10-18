<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MeetupUserRegistration
 *
 * @property int $id
 * @property int $meetup_id
 * @property int $user_id
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Meetup $meetup
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration whereMeetupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetupUserRegistration whereUserId($value)
 * @mixin \Eloquent
 */
class MeetupUserRegistration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function meetup()
    {
        return $this->belongsTo(Meetup::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
