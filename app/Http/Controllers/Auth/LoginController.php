<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo;

//if(Session::has('contact_visited'))
//{
//$redirectTo='/checkout';
//}else{
//    $redirectTo='/contact';
//
//}
    /**
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }





    public function showLoginForm()
    {
        return view('auth.new-login');
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

//    protected function authenticated(Request $request, $user)
//    {
//        if (Session::has('bus_checkout_info')) {
//            dd("checkout session ");
//        } else {
//            dd("NO checkout session ");
//
//        }
//    }

    protected function redirectTo()
    {
        if (Session::has('bus_checkout_info')) {
            return route('payment');
        }else{
            if(Auth::check() && Auth::user()->role->id == 1 ){
                return route('superadmin.busses.index');
            }else if(Auth::check() && Auth::user()->role->id == 2 ){
                return route('admin.busses.index');
            }else if(Auth::check() && Auth::user()->role->id == 3 ){
                return route('profile');
            }
        }

    }
}
