<?php

namespace App\Http\Controllers;


use App\Bus;
use App\BusBookedSeats;
use App\Seat;
use App\UserBookedSeats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SeatController extends Controller
{

    public function partial_seat_layout(Bus $bus, $travel_date)
    {
        $unav_seat = BusBookedSeats::where([
            'booked_date'=> $travel_date,
            'bus_id' => $bus->id,
        ])->first();
        if($unav_seat === null){
            return view('layouts.seat_layout', compact('bus'));
        }else{
            return view('layouts.seat_layout', compact('bus', 'unav_seat'));
        }

    }

    public function checkout(Request $request)
    {
        $bus = Bus::findOrFail($request->bus);

        return view('booking.checkout', (
            [
                'request' => $request,
                'bus' => $bus
            ]
        ));
    }

    public function paymentPost(Request $request)
    {

        $selected_seat_info = json_decode($request->all_seat_info, TRUE);

        if(Auth::check()){
            global $user_booked_id;
            $this->insert($selected_seat_info);
            //return view('booking.payment', compact('selected_seat_info'));
            return redirect('profile/report/'.Crypt::encrypt($user_booked_id))->with('success_msg','Seat successfully booked with e-payment.');
//            return redirect()->action(
//                'SeatController@PaymentShow', ['requests' => $request]
//            );

        }else{
            Session::put('bus_checkout_info', $selected_seat_info);
            return Redirect::route('login')->with('error_message', 'Please Login before making payment.');
        }
    }

    public function paymentGet(Request $request)
    {
        global $user_booked_id;

        if (Session::has('bus_checkout_info')) {
            $selected_seat_info = Session::get('bus_checkout_info');

            if (Auth::check()) {
//                $selected_seat_info = json_decode($request->all_seat_info, TRUE);

                $this->insert($selected_seat_info);
                Session::forget('bus_checkout_info');
                //return view('booking.payment', compact('selected_seat_info'));
                return redirect('profile/report/'.Crypt::encrypt($user_booked_id))->with('success_msg','Seat successfully booked with e-payment.');
            } else {
                abort(404);
            }
        }else{
            return redirect('/');
        }
    }

    private function insert($data){
        global $user_booked_id;

        //dd($data['selected_seats_id']);

        $booked_bus = BusBookedSeats::where([
            'booked_date'=> $data['booked_date'],
            'bus_id' => $data['bus'],
            ])->first();
        if ($booked_bus === null) {
            // Booked bus does not exist
            //dd("doesnt exists");
            $bus_booked_seats = new BusBookedSeats;

            $bus_booked_seats->bus_id = $data['bus'];
            $bus_booked_seats->booked_seats_id = $data['selected_seats_id'];
            $bus_booked_seats->booked_seats_num = $data['selected_seats_num'];
            $bus_booked_seats->booked_date = $data['booked_date'];

            $bus_booked_seats->save();
        } else {
            // Booked bus exist
            //dd("exist"."already");
            $booked_bus->booked_seats_id = $booked_bus->booked_seats_id.", ".$data['selected_seats_id'];
            $booked_bus->booked_seats_num = $booked_bus->booked_seats_num.", ".$data['selected_seats_num'];

            $booked_bus->update();

        }


        $user_booked_seats = new UserBookedSeats;
        $user_booked_seats->bus_id = $data['bus'];
        $user_booked_seats->user_id = Auth::id();
        $user_booked_seats->seats_id = $data['selected_seats_id'];
        $user_booked_seats->seats_num = $data['selected_seats_num'];
        $user_booked_seats->booked_date = $data['booked_date'];
        $user_booked_seats->total_price = $data['total_price'];
        //dd($user_booked_seats);
        $user_booked_seats->save();

        $user_booked_id = $user_booked_seats->id;
    }


}
