<?php

namespace App\Models;

use App\Models\Traits\Shortcode;
use App\Models\Traits\Slug;
use Illuminate\Database\Eloquent\Model;

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
