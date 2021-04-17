<?php

namespace App\Http\Controllers;

use App\UserBookedSeats;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserBookedSeatsController extends Controller
{
    public function all_report(){
        if(Auth::check()) {

            $reports = UserBookedSeats::with('bus')->where('user_id', '=', Auth::id())
                ->get();
            return view('profile.all_reports', compact('reports'));
        }else
            abort(404);
    }

    public function report($id){
        try {
            $report_id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $report = UserBookedSeats::findOrFail($report_id);
        //dd($bus);
        if(Auth::id()==$report->user_id)
            return view('profile.report',compact('report'));
        else
            abort(404);
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
     * @param  \App\UserBookedSeats  $userBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function show(UserBookedSeats $userBookedSeats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserBookedSeats  $userBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBookedSeats $userBookedSeats)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserBookedSeats  $userBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBookedSeats $userBookedSeats)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserBookedSeats  $userBookedSeats
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBookedSeats $userBookedSeats)
    {
        //
    }
}
