<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Booking;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->hasRole('admin')){

            if($request->search){

                $users = User::when($request->search, function($q) use ($request){

                    return $q->where('name', 'like' , '%' . $request->search . '%');

                })->latest()->paginate(4);

                return view('admin.users.index', compact('users'));


            } else {

                return view('admin.users.index')->with('users', User::paginate(5));
            }
            
        } else {
            if(Auth::user()->id==1){
                $bookings = Booking::join('flights', 'flights.id','=','bookings.flight_id')
                ->join('users','users.id','=','flights.user_id')->get(['bookings.credit_id','bookings.id','flights.airline_type','flights.airline_name','users.name','flights.from','flights.to','flights.departure_date','flights.time','flights.price']);
                // $booking_customers = Booking::join('users', 'users.id','=','bookings.user_id')
                //                     ->get(['users.name']);
        
            }
            
            else{
                
                $bookings = Booking::join('flights', 'flights.id','=','bookings.flight_id')
                ->join('users','users.id','=','flights.user_id')
                ->where('users.id',Auth::user()->id)
                ->get(['bookings.credit_id','users.name','bookings.id','flights.airline_type','flights.airline_name','users.name','flights.from','flights.to','flights.departure_date','flights.time','flights.price']);
                // $booking_customers = Booking::join('users', 'users.id','=','bookings.user_id')
                //                     ->first();
        
            }
            return redirect()->route('dashboard') ->with(['bookings'  =>  $bookings , 'booking_customers' => $booking_customers]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);


        $user = User::find($id);
        $user->update($request->all());

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->hasRole('admin')){

            return redirect()->route('admin.users.index')->with('error', 'This user cant be Deleted'); 
        }

        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User Deleted successfully');
          
    }
    public function destroybooking($id)
    {
        $booking = Booking::find($id);
        $booking->delete();

       
        
        return redirect()->route('dashboard')->with('success', 'Ticket Cancelled successfully');
          
    }
    
}
