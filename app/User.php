<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use softDeletes;
    use Notifiable;

    const ADMIN_TYPE_SUPERADMIN = 'superadmin';
    const ADMIN_TYPE_ADMIN = 'admin';
    const DOCTOR_TYPE = 'doctor';
    const NURSE_TYPE = 'nurse';
    const RECEPTIONIST_TYPE = 'receptionist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'title', 
        'forename', 
        'surname', 
        'email', 
        'dateOfBirth',
        'password', 
        'active', 
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === self::ADMIN_TYPE_SUPERADMIN || self::ADMIN_TYPE_ADMIN;
    }

    public function isDoctor()
    {
        return $this->role === self::DOCTOR_TYPE;
    }

    public function isNurse()
    {
        return $this->role === self::NURSE_TYPE;
    }


    public function isReceptionist()
    {
        return $this->role === self::RECEPTIONIST_TYPE;
    }
}
