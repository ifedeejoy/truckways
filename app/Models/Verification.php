<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    protected $fillable = [
        'driver', 'status',
    ];

    protected $table = 'verification_requests';

    public function drivers()
    {
        return $this->belongsTo(Drivers::class, 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admins::class, 'id');
    }
}
