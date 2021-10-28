<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flight;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
  
        // $starts = Flight::select('from')->groupBy('from')->pluck('from');
        $airline_types = DB::table('flights')->groupBy('airline_type')->get();
        
        return view('pages.index', compact('airline_types'));

    }
}
