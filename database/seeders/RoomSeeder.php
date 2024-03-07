<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($x = 1; $x <= 100; $x++) {
            for ($y = 1; $y <= 10; $y++) {
                Room::create([
                    'floor_id' => $x,
                    'room_number' => $y, 
                    'room_type' => 'Single Room', 
                    'room_size' => 'big', 
                    'rate' => '$1000',
                    'description' => 'just a test',
                    'status' => 'vacant',
                ]);
            };

          };
    }
}
