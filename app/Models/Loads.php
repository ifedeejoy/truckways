<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loads extends Model
{
    //
    protected $fillable = [
        'reference', 'user', 'pickup', 'delivery', 'truck_type', 'isPremium', 'budget', 'price', 'images',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bids::class, 'load');
    }

    public function driver()
    {
        return $this->hasOne(Drivers::class, 'id');
    }

    public function journey()
    {
        return $this->hasMany(Journey::class, 'load');
    }

    public function admin()
    {
        return $this->belongsTo(Admins::class);
    }
}
