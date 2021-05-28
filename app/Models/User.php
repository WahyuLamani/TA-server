<?php

namespace App\Models;

use App\Models\Client\Agent;
use App\Models\Client\Distributor;
use App\Models\Server\Company;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'roles',
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

    public function agents()
    {
        return $this->hasOne(Agent::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function distributor()
    {
        return $this->hasOne(Distributor::class);
    }
}
