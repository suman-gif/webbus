<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Mail\TestMail;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');

});

// Route::get('/new-login', function () {
//     return view('auth.new-login');

// });

// Route::get('/email', function () {
// 	Mail::to('test@test.com')->send(new TestMail());
//     return new TestMail();

// });

//Auth::routes();
Auth::routes(['verify' => true]);

Route::view('/contact','contact')->name('contact');


//Route::resource('busses', 'BusController'); no need for index,create,store,show.....


Route::group([ 'as'=>'admin.', 'prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth','admin'] ],
	function(){

			Route::get('/busses', 'BusController@index')->name('busses.index');
			Route::get('/busses/create','BusController@create')->name('busses.create');
			Route::post('/busses','BusController@store')->name('busses.store');
			Route::get('/busses/{bus}','BusController@show');
			Route::get('/busses/{bus}/edit','BusController@edit');
			Route::patch('/busses/{bus}','BusController@update');
			Route::delete('/busses/{bus}','BusController@destroy');



			Route::get('/holidays/{bus}', 'HolidayController@show');
			Route::get('/holidays/{bus}/create','HolidayController@create');
			Route::post('/holidays','HolidayController@store')->name('holidays.store');

			Route::post('/busses/report','BusBookedSeatsController@report')->name('bus.report');
            Route::get('/cancellation/', 'CancellationController@index');
            Route::get('/cancellation/{id}', 'CancellationController@show');
            Route::get('/cancellation/{id}/accept', 'CancellationController@accept');
            Route::get('/cancellation/{id}/reject', 'CancellationController@reject');
	}
);


Route::group([ 'as'=>'superadmin.', 'prefix'=>'superadmin', 'namespace'=>'SuperAdmin', 'middleware'=>['auth','superadmin'] ],
	function(){


			Route::get('/busses', 'BusController@index')->name('busses.index');
			Route::get('/busses/{bus}','BusController@show');
			Route::delete('/busses/{bus}','BusController@reject');
			Route::patch('/busses/{bus}','BusController@approve');

			Route::get('/users', 'UserController@index')->name('users.index');
			Route::get('/users/{user}','UserController@show');
			Route::delete('/users/{user}','UserController@set_user');
			Route::patch('/users/{user}','UserController@set_admin');

			Route::post('/busses/','BusController@mass_status')->name('busses.mass_status');
			Route::post('/users/','UserController@mass_role')->name('users.mass_role');


			Route::get('/users/{user}/busses', 'UserController@user_bus');
	}
);



Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/profile/{user}/edit','ProfileController@edit');
Route::patch('/profile/{user}','ProfileController@update');




Route::get('/profile/{user}/password','ProfileController@edit_password');
Route::patch('/password/{user}','ProfileController@update_password');

Route::get('/profile/{user}/email','ProfileController@edit_email');
Route::patch('/email/{user}','ProfileController@update_email');

Route::post('/available-bus','BusListController@index')->name('available_bus');
Route::get('/available-bus', function() {
    return redirect('/');
});


// Route::fallback(function () {
//     return abort('404');
// });

Route::get('/get_seat_layout/{bus}/{travel_date}','SeatController@partial_seat_layout');

Route::post('/checkout', 'SeatController@checkout');
Route::get('/checkout', function() {
    return redirect('/');
});
Route::post('/payment', 'SeatController@paymentPost');

//Route::get('/payment', 'SeatController@payment')->middleware('auth');

Route::get('/payment', 'SeatController@paymentGet')->name('payment');


Route::get('/check-session', function () {
    if (Session::has('bus_checkout_info')) {
        dd("Checkout session set");
    }});


Route::get('/profile/reports','UserBookedSeatsController@all_report')->name('user.all_report');
Route::get('/profile/report/{id}','UserBookedSeatsController@report')->name('user.report');
Route::post('/profile/report/cancel','UserBookedSeatsController@reportCancel')->name('user.report.cancel');
