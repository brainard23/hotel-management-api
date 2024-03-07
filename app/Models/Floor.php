<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Building;
use App\Models\Room;

class Floor extends Model
{
    use HasFactory;

    public function building() 
    {
        return $this->belongsTo(Building::class); 
    }

    public function rooms() 
    {
        return $this->hasMany(Room::class);
    }
}
