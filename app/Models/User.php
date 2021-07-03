<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    // public function findForPassport($identifier) {
    //     return $this->orWhere('email', $identifier)->orWhere('user_name', $identifier)->orWhere('phone', $identifier)->first();
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'first_name',
        'role',
        'img',
        'middle_name',
        'last_name',
        'user_name',
        'email',
        'phone',
        'address',
        'password',
        'biography',
        'id_number',
        'passport_no',
        'dob',
        'city',
        'postal_code',
        'physical_address',
        'suspended_at',
        'email_verified_at',
        'id_verified_at',
        'gender',
        'nationality',
        'approved_by',
        'registered_by',
        'suspended_by',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function accessTokens()
    {
        return $this->hasMany('App\OauthAccessToken');
    }
}
