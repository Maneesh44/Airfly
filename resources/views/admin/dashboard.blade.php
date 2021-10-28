@extends('layouts.master')

@section('title')
    Dashboard | reservation system
@endsection

@section('name')
    Dashboard
@endsection

@section('content')




                    
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <h4 class="card-title float-left"> Booking List</h4>
          </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
              <thead class="text-info">
            {{-- <thead class="text-secondary"> --}}
              <th>Airline Type</th>
              <th>Airline Name</th>
              <th>Owner Name</th>
              <th>PNR Number</th>
              <th>From</th>
              <th>To</th>
              <th>Departure Date</th>
              <th>Time</th>
              <th>Price</th>
              <th>Cancel</th>

            </thead>
            <tbody>
              @foreach ($bookings as $booking)
                  
              <tr>
                <td>{{$booking->airline_type}}</td>
                <td>{{$booking->airline_name}}</td>
                <td>{{$booking->name}}</td>
                <td>{{$booking->id}}</td>
                <td>{{$booking->from}}</td>
                <td>{{$booking->to}}</td>
                <td>{{$booking->departure_date}}</td>
                <td>{{$booking->time}}</td>
                <td>₹ {{$booking->price}}</td>
                
                
                <td>
                   <form action="{{ route('admin.destroybooking', $booking->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger btn-sm">CANCEL</button>
                  </form> 
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
            
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
    
@endsection