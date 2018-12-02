<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Events\UserCreateEvent;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * events should be fired
     * @var [type]
     */
    protected $dispatchesEvents = [
       'created' => UserCreateEvent::class,
    ];

    /**
     * this is a mutator for password, no need to encrypt password at
     * the time of insertiin
     *
     * @param string $value raw password
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function userProfile()
    {
        return $this->hasOne('App\Models\UserProfile');
    }
}
