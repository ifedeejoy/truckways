<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trucks extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'driver', 'name', 'model', 'type', 'plate_number', 'images',
    ];

    public function drivers()
    {
        return $this->belongsTo(Drivers::class, 'id');
    }

    public function bids()
    {
        return $this->hasMany(Bids::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admins::class);
    }
}
