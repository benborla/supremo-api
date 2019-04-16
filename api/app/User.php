<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $email
 * @property boolean $status
 * @property boolean $active
 * @property \Carbon\Carbon $emailVerifiedAt
 * @property string $password
 * @property string $rememberToken
 * @property \Carbon\Carbon $createdAt
 * @property \Carbon\Carbon $updatedAt
 *
 * @property-read string $fullNane
 *
 * Class User
 * @package App
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => 'boolean',
        'active' => 'boolean',
    ];


    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @param \Carbon\Carbon $emailVerifiedAt
     *
     * @return $this
     */
    public function setEmailVerifiedAtAttribute(\Carbon\Carbon $emailVerifiedAt)
    {
        $this->emailVerifiedAt = $emailVerifiedAt;

        return $this;
    }

    /**
     * @return \Carbon\Carbon
     */
    public function getEmailVerifiedAtAttribute()
    {
        return $this->attributes['email_verified_at'];
    }
}
