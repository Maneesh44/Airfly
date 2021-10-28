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
use Illuminate\Support\Facades\Auth;
use App\Booking;
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth' ,'verified']);


// Github login
Route::get('login/github', 'Auth\LoginController@redirectToProvider')->name('login/github');
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback');



// admin dashboard
Route::get('/admin', function(){
    // $bookings = Booking::latest()->paginate(6);
    // return redirect()->route('dashboard') ->with(['bookings'  =>  $bookings]);
    if(Auth::user()->id==1){
        $bookings = Booking::join('flights', 'flights.id','=','bookings.flight_id')
        ->join('users','users.id','=','flights.user_id')->get(['bookings.credit_id','bookings.id','flights.airline_type','flights.airline_name','users.name','flights.from','flights.to','flights.departure_date','flights.time','flights.price']);
        // $booking_customers = Booking::join('users', 'users.id','=','bookings.user_id')
        // ->where('bookings.user_id',Auth::user()->id)->get();

    }
    
    else{
        
        $bookings = Booking::join('flights', 'flights.id','=','bookings.flight_id')
        ->join('users','users.id','=','flights.user_id')
        ->where('users.id',Auth::user()->id)
        ->get(['bookings.credit_id','users.name','bookings.id','flights.airline_type','flights.airline_name','users.name','flights.from','flights.to','flights.departure_date','flights.time','flights.price']);
        // $booking_customers = Booking::join('users', 'users.id','=','bookings.user_id')
        // ->where('bookings.user_id',)->get();

    }



     

    
    
    
    return view('admin.dashboard')->with(['bookings'  =>  $bookings]);

})->middleware(['auth', 'admin'])->name('dashboard');


Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function(){
        Route::resource('/users', 'UsersController')->except(['create', 'store', 'show']);
        Route::resource('/flights' ,'FlightsController')->except(['create', 'show']);
        Route::get('markAsRead', 'NotifyController@notify')->name('markRead');
        Route::delete('/deletebooking/{id}', 'UsersController@destroybooking')->name('destroybooking');
});

// Home Page
Route::get('/', 'DynamicDependentController@index')->name('index');
Route::get('/returnFlight', 'DynamicDependentController@returnFlight')->name('returnFlight');
Route::post('/fetch', 'DynamicDependentController@fetch')->name('index.fetch');
Route::post('/search', 'DynamicDependentController@search')->name('index.search');
Route::post('/store', 'DynamicDependentController@store')->name('store');


Route::middleware('verified')->group(function(){

	// contact page
	Route::get('/contact', 'pagesController@contact')->name('contact');
	
	Route::post('/contact', 'pagesController@store')->name('contactUs');
});