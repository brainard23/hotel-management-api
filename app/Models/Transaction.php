<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function transaction() 
    {
        return $this->belongsTo(User::class);
    }
    public function bookings() 
    {
        return $this->belongsTo(Booking::class);
    }

}
