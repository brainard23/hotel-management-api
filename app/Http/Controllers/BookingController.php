<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'required',
            'room_id' => 'required',
            'booked_from' => 'required|date_format:Y-m-d H:i:s',
            'booked_to' => 'required|date_format:Y-m-d H:i:s',
        ]); 

        $isReserved = Room::where('id', $request->room_id)->first();
        Log::info('Booking' .  $isReserved);
        if ($isReserved->status !== 'reserved') {
            DB::transaction(function () use ($request){
                Booking::firstOrCreate([
                   'user_id' => $request->user_id,
                   'room_id' => $request->room_id,
                   'booked_from' => $request->booked_from,
                   'booked_to' => $request->booked_to,
                   'status' => 'pending',
               ]);
               
            
            }); 

            $isReserved->status = 'reserved';
            $isReserved->save();
        } else {
            return response([
                'message' => 'Room is already reserved',
            ], 500);
        }
        
        return response([
            'message' => 'success',
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
