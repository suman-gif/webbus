<?php

namespace App\Http\Controllers;

use App\BusBookedSeats;
use App\Cancellation;
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

    public function reportCancel(Request $request)
    {
        $user_ticket = UserBookedSeats::findOrFail($request['report_id']);
        $user_ticket->status = "Pending Cancellation";
        //dd($user_ticket['seats_num']);
//        $booked_bus = BusBookedSeats::where([
//            'booked_date'=> $user_ticket->bus_id,
//            'booked_date' => $user_ticket['booked_date'],
//        ])->first();
//
//        $bus_booked_seats_num = explode(', ', $booked_bus['booked_seats_num']);
//        $user_booked_seats_num = explode(', ', $user_ticket['seats_num']);
//
//        $updated_bus_seat_num = array_diff($bus_booked_seats_num, $user_booked_seats_num);
//        //print_r($updated_bus_seat_num);
//
//        $bus_booked_seats_id = explode(', ', $booked_bus['booked_seats_id']);
//        $user_booked_seats_id = explode(', ', $user_ticket['seats_id']);
//
//        $updated_bus_seat_id=array_diff($bus_booked_seats_id, $user_booked_seats_id);
//        //print_r($updated_bus_seat_id);
//
//
//        $booked_bus->booked_seats_num = implode(', ', $updated_bus_seat_num);
//        $booked_bus->booked_seats_id = implode(', ', $updated_bus_seat_id);
//
//        //dd($booked_bus);

        //$booked_bus->update();

        $cancel_request = new Cancellation();

        $cancel_request->bus_id = $user_ticket->bus_id;
        $cancel_request->user_id = $user_ticket->user_id;
        $cancel_request->report_id = $user_ticket->id;
        $cancel_request->reason = $request['reason'];

        $user_ticket->update();
        $cancel_request->save();

        return redirect('profile/report/'.Crypt::encrypt($user_ticket->id))->with('success_msg','Seat cancellation request submitted.');

    }


}
