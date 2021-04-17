<?php

namespace App\Http\Controllers\Admin;

use App\Holiday;
use App\Bus;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($bus)
    {
        $bus = Bus::findOrFail($bus);

        if(Auth::id()==$bus->user_id){
            $holidays = Holiday::all()->where('bus_id',$bus->id);
            return view('admin.holidays.show',compact('holidays','bus'));
        }else
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Bus $bus)
    {
        if(Auth::id()==$bus->user_id){
            return view('admin.holidays.create',compact('bus'));
        }else
            abort(404);

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
            'date_from' => 'required',
            'date_to' => 'required',
        ]);

        $data['description'] = $request['description'];
        $data['bus_id'] = $request['bus_id'];

        Holiday::create($data);
        return redirect('admin/holidays/'.$data['bus_id'])->with('success_msg','Holiday successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        //
    }
}
