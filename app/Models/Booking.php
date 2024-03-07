<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';

    protected $fillable = [
        'user_id',
        'room_id',
        'booked_from',
        'booked_to',
        'status',
    ];

    public function transactions() 
    {
        return $this->hasMany(Transaction::class);
    }
}
