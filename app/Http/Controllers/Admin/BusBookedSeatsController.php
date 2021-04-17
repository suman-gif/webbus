<?php

namespace App\Http\Controllers\Admin;

use App\BusBookedSeats;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusBookedSeatsController extends Controller
{
    public function report(Request $request)
    {
        $bus_report = BusBookedSeats::where('bus_id','=',$request['bus_id'])->get();
        return view('admin.busses.report',compact('bus_report'));

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BusBookedSeats  $busBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function show(BusBookedSeats $busBookedSeats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BusBookedSeats  $busBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function edit(BusBookedSeats $busBookedSeats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BusBookedSeats  $busBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusBookedSeats $busBookedSeats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BusBookedSeats  $busBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusBookedSeats $busBookedSeats)
    {
        //
    }
}
