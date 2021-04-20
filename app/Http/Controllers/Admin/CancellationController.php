<?php

namespace App\Http\Controllers\Admin;

use App\Bus;
use App\BusBookedSeats;
use App\Cancellation;
use App\Http\Controllers\Controller;
use App\UserBookedSeats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CancellationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_bus = Bus::where('user_id',Auth::id())->get('id');

        $bus_id_arr=[];

        foreach ($admin_bus as $bus){
            array_push($bus_id_arr,$bus['id']);
        }
        $bus_report = Cancellation::with('user')->whereIn('bus_id', $bus_id_arr)->get();
        return view('admin.cancellation.index',compact('bus_report'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Cancellation  $cancellation
     * @return \Illuminate\Http\Response
     */
    public function show($cancellation)
    {
        $cancellation = Cancellation::findOrFail($cancellation);
        return view('admin.cancellation.show',compact('cancellation'));
    }

    public function accept($cancellation)
    {
        $cancellation = Cancellation::findOrFail($cancellation);

        $user_ticket = UserBookedSeats::findOrFail($cancellation->report_id);
        $user_ticket->status = "Cancelled";

       //dd($user_ticket['seats_num']);
        $booked_bus = BusBookedSeats::where([
            'booked_date'=> $user_ticket->bus_id,
            'booked_date' => $user_ticket['booked_date'],
        ])->first();
        //dd($booked_bus['booked_seats_num']);
        $bus_booked_seats_num = explode(', ', $booked_bus['booked_seats_num']);
        $user_booked_seats_num = explode(', ', $user_ticket['seats_num']);

        $updated_bus_seat_num = array_diff($bus_booked_seats_num, $user_booked_seats_num);
        //print_r($updated_bus_seat_num);

        $bus_booked_seats_id = explode(', ', $booked_bus['booked_seats_id']);
        $user_booked_seats_id = explode(', ', $user_ticket['seats_id']);

        $updated_bus_seat_id=array_diff($bus_booked_seats_id, $user_booked_seats_id);
        //print_r($updated_bus_seat_id);


        $booked_bus->booked_seats_num = implode(', ', $updated_bus_seat_num);
        $booked_bus->booked_seats_id = implode(', ', $updated_bus_seat_id);

        //dd($booked_bus);

        $booked_bus->update();
        $user_ticket->update();

        return redirect('admin/cancellation');
    }

    public function reject($cancellation)
    {
        $cancellation = Cancellation::findOrFail($cancellation);

        $user_ticket = UserBookedSeats::findOrFail($cancellation->report_id);
        $user_ticket->status = "Active/Cancellation Rejected";
        $user_ticket->update();

        return redirect('admin/cancellation');


    }

}
