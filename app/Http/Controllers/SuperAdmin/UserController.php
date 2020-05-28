<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Bus;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
    	$users = User::all();

    	return view('superadmin.users.index',compact('users'));
    }

    public function show(User $user)
    {   
        if(Auth::id()==1)
           return view('superadmin.users.show',compact('user'));
        else
            abort(404);

    }

    
     public function set_user(User $user)
    {
        $user['role_id']=3;        
        $user->save();
        return redirect('superadmin/users/'.$user['id']);
    }

    public function set_admin(User $user)
    {
        $user['role_id']=2;        
        $user->save();
        return redirect('superadmin/users/'.$user['id']);
    }


    public function mass_role(Request $request){
        $type = $request['role_type'];

        foreach($request['role'] as $id => $role){
           $user = User::find($id);

           $user['role_id'] = $type;
           $user->save();

        }

        return redirect('superadmin/users')->with('success_msg','User\'s role successfully updated.');
    }

    public function user_bus(User $user){
        $busses = Bus::all()->where('user_id',$user->id);
        //dd($busses);
        return view('superadmin/users/bus',compact('busses'));
    }

}
