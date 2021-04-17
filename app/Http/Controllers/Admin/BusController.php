<?php

namespace App\Http\Controllers\Admin;

use App\Bus;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }


    public function index()
    {
        $user = Auth::id();
        $busses = Bus::where('user_id',$user)->get();
        return view('admin/busses/index',compact('busses'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.busses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'name' => 'required',
            'reg_num' => 'required|unique:buses',
            'from_location' => 'required',
            'to_location' => 'required',
            'start_time' => 'required',
            'time_to_reach' => 'required',
            'seat_num' => 'required',
            'price' =>'required',
        ]);

        $data['user_id'] = Auth::id();
        $data['description'] = $request['description'];

        $data['off_day'] ='';


        if ($request['off_day']) {
            $holiday_count = 0;

            foreach ($request['off_day'] as $off_day) {
                $holiday_count++;
                if( $holiday_count > 1 ){
                    $data['off_day'] .= ', ';
                }
                $data['off_day'] = $data['off_day'].$off_day;
            }
        }


        //dd($data);

        // Bus::create($data);
        // return redirect()->route('busses.index');

        $bus = Bus::create($data);
        return redirect('admin/busses/'.Crypt::encrypt($bus->id))->with('success_msg','Bus successfully added and is in review by the admin for approval..');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function show($bus)
    {
        //First way to get a row from sql

        try {
            $bus_id = Crypt::decrypt($bus);
        } catch (DecryptException $e) {
            return abort(404);
        }

        $bus = Bus::findOrFail($bus_id);
        //dd($bus);
        if(Auth::id()==$bus->user_id)
           return view('admin.busses.show',compact('bus'));
        else
            abort(404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        //Second way to get a row from sql
        return view('admin.busses.edit',compact('bus'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $data = request()->validate([
            'name' => 'required',
            'reg_num' => 'required|unique:buses,reg_num,'.$bus->id,
            'from_location' => 'required',
            'to_location' => 'required',
            'start_time' => 'required',
            'time_to_reach' => 'required',
            'seat_num' => 'required',
            'price' =>'required',
        ]);

        $data['description'] = $request['description'];
        $data['status'] = 'pending';

        $data['off_day'] ='';

        if ($request['off_day']) {
            $holiday_count = 0;

            foreach ($request['off_day'] as $off_day) {
                $holiday_count++;
                if( $holiday_count > 1 ){
                    $data['off_day'] .= ', ';
                }
                $data['off_day'] = $data['off_day'].$off_day;
            }
        }



        $bus->update($data);

        return redirect('admin/busses/'.$bus->id)->with('success_msg','Bus successfully updated and is in review by the admin for approval.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bus  $bus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('admin.busses.index');
    }


}
