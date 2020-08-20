<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bids::class, 'load');
    }

    public function driver()
    {
        return $this->hasMany(Drivers::class, 'id');
    }

    public function journey()
    {
        return $this->hasMany(Journey::class, 'load');
    }
}
