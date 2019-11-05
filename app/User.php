<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isModerator()
    {
        return $this->role == 2;
    }

    public function isAdmin()
    {
        return $this->role == 3;
    }

    public function ifEmailVerify()
    {
        return $this->email_verified_at != null;
    }

    public function getRoleName(){
        switch($this->role){
            case 1: {
                return 'user';
            } break;
            case 2: {
                return 'moderator';
            } break;
            case 3: {
                return 'admin';
            } break;
        }
    }
}
