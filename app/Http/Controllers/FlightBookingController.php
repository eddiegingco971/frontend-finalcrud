<?php

namespace App\Http\Controllers;

use App\Models\FlightBooking;
use Illuminate\Http\Request;

class FlightBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'flightBookings' => FlightBooking:: orderBy('user_id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=> 'numeric|required', 
            'airlines'=> 'string|required', 
            'category'=> 'string|required', 
            'travel_place'=> 'string|required', 
            'price'=> 'required', 
            'arrival'=> 'required', 
            'departure'=> 'required', 
        ]);
        $flightBooking = FlightBooking::create($request->only('user_id', 'airlines','category','travel_place','price','arrival','departure'));
        
        return response()->json($flightBooking);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FlightBooking  $flightBooking
     * @return \Illuminate\Http\Response
     */
    public function show(FlightBooking $flightBooking)
    {
        return response()->json($flightBooking);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FlightBooking  $flightBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(FlightBooking $flightBooking)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FlightBooking  $flightBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FlightBooking $flightBooking)
    {
        $flightBooking->update($request->only('user_id', 'airlines','category','travel_place','price','arrival','departure'));

        return response()->json($flightBooking);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FlightBooking  $flightBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(FlightBooking $flightBooking)
    {
        $airlines = $flightBooking->airlines;

            $flightBooking->delete();

            return response()->json([
            'deleted' => true,
            'message' => $airlines ." has been deleted by the owner."
         ]);
    }
}
