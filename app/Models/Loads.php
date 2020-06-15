<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loads extends Model
{
    //
    protected $fillable = [
        'reference', 'user', 'pickup', 'delivery', 'truck_type', 'image', 'load'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }
}
