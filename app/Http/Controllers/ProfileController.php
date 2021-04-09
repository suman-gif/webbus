<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

	public function __construct()
    {
    	$this->middleware('auth');

    }

    public function index(){
    	$profile = Auth::user();

    	return view('profile.index',compact('profile'));
    }

    public function edit(User $user)
    {
        if(Session::has('contact_visited')){
            dd("has");
        }
    	if(Auth::user()==$user)
        	return view('profile.edit_profile',compact('user'));
        else
        	abort('404');
    }

    public function update(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'district' => ['required', 'string'],
        ]);

        $user->update($data);

        return redirect('profile')->with('success_msg','Profile successfully updated.');
    }

    public function edit_password(User $user)
    {
        if(Auth::user()==$user)
        	return view('profile.change_password',compact('user'));
        else
        	abort('404');

    }

    public function update_password(Request $request, User $user)
    {
        $data = request()->validate([
            'password' => ['required', 'string', 'min:5', 'confirmed'],
            'old_password' => ['required', 'string','min:5']
        ]);


        $hashedpassword = Auth::user()->password;
        $id= Auth::id();

        if (Hash::check($request->old_password,$hashedpassword)){

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return redirect()->route('login')->with('success_msg','Password changed Successfully');

        } else{
            return redirect()->back()->with('error_msg','Invalid current password');
        }



        $user->update($data);

        return redirect('profile')->with('success_msg','Profile successfully updated.');
    }


    public function edit_email(User $user)
    {
        if(Auth::user()==$user)
            return view('profile.edit_email',compact('user'));
        else
            abort('404');

    }


    public function update_email(Request $request, User $user)
    {
        $data = request()->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);

        $user->email_verified_at = NULL;
        $user->update($data);

        return redirect('profile')->with('success_msg','Email successfully updated');
    }

}
