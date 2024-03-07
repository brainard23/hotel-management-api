<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function store(Request $request) 
    {
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);

            $data = Building::create([
                'name' => $request->name, 
                'address' => $request->address,
                'description' => $request->description,
            ]);

            return response([
                'message' => 'success',
                'data' => $data
            ]);

    }

    public function update(Request $request)
    {
        $data = Building::find($request->id);

        if ($data) {
            $data->name = $request->name;
            $data->address = $request->address;
            $data->description = $request->description;
            $data->save();
        } else {
            return response([
                'message' => 'data not found'
            ], 404);
        }
     

        return response([
            'message' => 'success',
            'data' => $data
        ]);
    }
    
}
