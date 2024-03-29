<?php

namespace Database\Seeders;

use App\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Building::create([
            'id'   => 1, 
            'name' => 'Delux Hotel', 
            'address' => 'Bon bon CDOC',
            'description' => 'the heart of cagayan hotel',
        ]);
    }
}
