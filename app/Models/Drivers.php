<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Drivers extends Authenticatable
{
    Use Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'idType', 'idImage', 'isVerified', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guard = 'truck_drivers';

    public function loads()
    {
        return $this->belongsTo(Loads::class);
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }
}
