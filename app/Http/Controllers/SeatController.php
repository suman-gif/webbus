<?php

namespace App\Http\Controllers;


use App\Bus;
use App\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SeatController extends Controller
{


    public function partial_seat_layout(Bus $bus)
    {
        return view('layouts.seat_layout', compact('bus'));

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
            return view('booking.payment', compact('selected_seat_info'));
        }else{
            Session::put('bus_checkout_info', $selected_seat_info);
            return Redirect::route('login')->with('error_message', 'Please Login before making payment.');
        }
    }

    public function paymentGet(Request $request)
    {
        if (Session::has('bus_checkout_info')) {
            $selected_seat_info = Session::get('bus_checkout_info');

            if (Auth::check()) {
                return view('booking.payment', compact('selected_seat_info'));
            } else {
                abort(404);
            }
        }else{
            return redirect('/');
        }
    }


}
