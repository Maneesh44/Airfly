<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Flight;
use App\Booking;
use App\Credit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class DynamicDependentController extends Controller
{

    public function __construct(){
        
        $this->middleware(['auth', 'verified'])->except('index');
    }

    
    function index(){

        $airline_types = DB::table('flights')->groupBy('airline_type')->get();
        return view('pages.index')->with('airline_types', $airline_types);

    }

    function fetch(Request $request){

        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('flights')->where($select, $value)->groupBy($dependent)->get();

        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        
        foreach($data as $row){

            $output.='<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
            
        }

        echo $output;
    }
    function search(Request $request){

        $airline_type = $request->get('airline_type');
        $from_val = $request->get('from_val');
        $to_val = $request->get('to_val');

        $departdate_val=$request->get('departdate_val');

        $newDate = date("Y-m-d", strtotime($departdate_val));
       
        $flight = DB::table('flights')
        ->where('airline_type', $airline_type)
        ->where('from', $from_val)
        ->where('to', $to_val)
        ->where('departure_date',$newDate)
        ->get();

        // dd($flight);
        // $flight = Flight::where(['from'=>$from_val, 'to'=>$to_val, 'departure_date'=>$departdate_val])->first();

        // $output = $airline_type ;
        // $output.= $data;

        if(!$flight->isEmpty()){
            $output='';
            $output.= '<div><div class="table-responsive" style="overflow:hidden;">
            <table class="table table-striped">
                <thead class="text-info">
             
               
                <th>Name</th>
                <th>Airline type</th>
                <th>From</th>
                <th>To</th>
                <th>Departure Date</th>
                <th>Time</th>
                <th>Arrival Date</th>
                <th>Price</th>
                <th>Choose</th>
                
    
              </thead>
              <tbody>';
               foreach ($flight as $flights){
                
               $output.= ' <tr>
                  
                  <td>'.$flights->airline_name.'</td>
                  <td>'.$flights->airline_type.'</td>
                  <td>'.$flights->from.'</td>
                  <td>'.$flights->to.'</td>
                  <td>'.$flights->departure_date.'</td>
                  <td>'.$flights->time.'</td>
                  <td>'.$flights->arrival_date.'</td>
                  <td>₹ '.$flights->price.'</td>
                  <td> <input class="flight-radio" type="radio"  name="choose-flight" value="'.$flights->id.'"></td>
                  
                  
                </tr>';
               }
               $output.= ' </tbody>
            </table><div>
            <button id="book-now" type="button" class="btn btn-info btn-block book-hide" data-toggle="modal" data-target="#exampleModal">Book Now</button>
          </div>';
        }
        else{
            $output ='<div class="no-flight"><h1>No Flights Available</h1></div>';
        }


       
        
        echo $output;
    }


    function returnFlight(Request $request){
        $from = $request->input('from');
        $to = $request->input('to');
        $departure_date = $request->input('departure_date');
        if (! $from ){
            abort(404);
         }

         $flight = Flight::where(['from'=>$from, 'to'=>$to, 'departure_date'=>$departure_date])->first();

         return $flight;
    }

    function store(Request $request){


            $this->validate($request, [
                'cname' => 'required|string',
                'ccnum' => 'required|integer',
                'expdate' => 'required|date',
                'cvv' => 'required|integer'
            ]);

            $credit = new Credit;
            $credit->cname = $request->cname;
            $credit->ccnum = $request->ccnum;
            $credit->expdate = Carbon::createFromFormat('m/d/Y', $request->input('expdate'))->format('Y-m-d');
            $credit->cvv = $request->cvv;
            $credit->user_id = Auth::user()->id;

            $credit->save();




         $book = new Booking;
         $book->flight_id = $request->flight_id;
         $book->user_id = Auth::user()->id;
         $book->credit_id = $credit->id;

         $book->save();
         

         return response()->json(['success' => 'Credit Added Successfuly' , 'id' => $credit->id ]);

    }

}
