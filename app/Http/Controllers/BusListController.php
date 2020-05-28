<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Bus;
use App\Holiday;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class BusListController extends Controller
{
    public function index(Request $request){

    	$travel_date = $request->travel_date; //suppose 2076-12-01
        $travel_day = $request->travel_day; //suppose Saturday



        //dd($request->all());


        //dd(date('D', strtotime($request->travel_date)));

        //display = true at first

            $busses = Bus::all();
        foreach ($busses as $bus) {

            $data['display'] = true;

            $bus->update($data);
        }


        //display = false if holidays

        $holidays = Holiday::where('date_from','<=',$travel_date)
                ->where('holidays.date_to','>=',$travel_date) ->get();

        foreach ($holidays as $holiday) {
            $data['display'] = false;
            $bus = Bus::find($holiday->bus->id);
            $bus->update($data);
        }



    	$busses = Bus::where([
    		'buses.from_location'	=>	$request->from_location, //Suppose Dharan
    		'buses.to_location'		=>	$request->to_location,      //Biratnagar
    		'buses.status'	=>	'approved',
            'display' => true

    		])
            ->where('off_day', 'not like', "%".$travel_day."%")

             ->get();


             //dd($busses);

    	return view('booking.available_bus',compact('busses','travel_date'));
    }
}
