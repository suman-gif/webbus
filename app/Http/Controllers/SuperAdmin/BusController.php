<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bus;
use Illuminate\Support\Facades\Auth;

class BusController extends Controller
{
    public function index(){
    	$busses = Bus::all();

    	return view('superadmin.busses.index',compact('busses'));
    }

    public function show(Bus $bus)
    {   
        if(Auth::id()==1)
           return view('superadmin.busses.show',compact('bus'));
        else
            abort(404);

    }

    
     public function reject(Bus $bus)
    {
        $bus['status']='rejected';        
        $bus->save();
        return redirect('superadmin/busses/'.$bus['id']);
    }

    public function approve(Bus $bus)
    {
        $bus['status']='approved';        
        $bus->save();
        return redirect('superadmin/busses/'.$bus['id']);
    }

    public function mass_status(Request $request){
        // dd($request['status_mark']);
        $stat = $request['status_mark'];

        foreach($request['status'] as $id => $status){
           $bus = Bus::find($id);

           $bus->status = $stat;
           $bus->save();

        }

        return redirect('superadmin/busses')->with('success_msg','Busses status successfully updated.');
    }


}
