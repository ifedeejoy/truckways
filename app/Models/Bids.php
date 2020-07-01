<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    protected $fillable = [
        'load', 'driver', 'amount', 'status',
    ];

    public function loads()
    {
        return $this->belongsTo(Loads::class, 'id');
    }

    public function driver()
    {
        return $this->belongsTo(Drivers::class, 'drivers');
    }

    public function trucks()
    {
        return $this->belongsTo(Trucks::class);
    }
}
