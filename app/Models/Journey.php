<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    protected $fillable = [
        'load', 'event', 'location', 'updatedBy'
    ];

    public function loads()
    {
        return $this->belongsTo(Loads::class, 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admins::class);
    }
}
