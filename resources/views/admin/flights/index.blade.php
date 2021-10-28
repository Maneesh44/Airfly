@extends('layouts.master')

@section('title')
    Flights | reservation system
@endsection

@section('name')
    Flights List
@endsection

@section('form')

  <form method="get" action="{{ route('admin.flights.index') }}">
    <div class="input-group no-border">
        <input type="text" value="{{ request()->search }}" class="form-control" placeholder="Search..." name="search">
        <div class="input-group-append">
          <div class="input-group-text">
            <i class="now-ui-icons ui-1_zoom-bold"></i>
          </div>
        </div>
    </div>
  </form>

@endsection

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Flight Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin.flights.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                
              <div class="form-group">
                <label>AIRLINE TYPE (AIRLINE / HELICOPTER)</label>
                <input type="text" name="airline_type" id="airline_type" class="form-control">
            </div>
            <div class="form-group">
                <label>AIRLINE NAME</label>
                <input type="text" class="form-control" id="airline_name" name="airline_name">
            </div>

              <div class="form-group">
                  <label for="from" class="col-form-label">FROM:</label>
                  <input type="text" class="form-control" id="from" name="from">
                </div>
                <div class="form-group">
                  <label for="to" class="col-form-label">TO:</label>
                  <input type="text" class="form-control" id="to" name="to">
                </div>
                <div class="form-group">
                  <label for="departure_date" class="col-form-label">DEPARTURE DATE:</label>
                  <input type="text" class="form-control date" id="departure_date" name="departure_date" placeholder="MM/DD/YYYY" >
                </div>
                <div class="form-group">
                  <label for="time" class="col-form-label">TIME:</label>
                  <input type="text" class="form-control" id="time" name="time">
                </div>
                <div class="form-group">
                  <label for="arrival_date" class="col-form-label">ARRIVAL DATE:</label>
                  <input type="text" class="form-control date" id="arrival_date" name="arrival_date" placeholder="MM/DD/YYYY" >
                </div>
                <div class="form-group">
                  <label for="price" class="col-form-label">PRICE:</label>
                  <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                  <label for="available_seats" class="col-form-label">AVAILABLE SEATS:</label>
                  <input type="text" class="form-control" id="available_seats" name="available_seats">
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title float-left"> Flights List</h4>
            <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#exampleModal">Add Flight</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
                <thead class="text-info">
              {{-- <thead class="text-secondary"> --}}
                <th>ID</th>
                <th>Name</th>
                <th>Airline type</th>
                <th>From</th>
                <th>To</th>
                <th>Departure Date</th>
                <th>Time</th>
                <th>Arrival Date</th>
                <th>Price</th>
                <th>Available Seats</th>
                <th>Edit</th>
                <th>Delete</th>

              </thead>
              <tbody>
                @foreach ($flight as $flights)
                    
                <tr>
                  <td>{{$flights->id}}</td>
                  <td>{{$flights->airline_name}}</td>
                  <td>{{$flights->airline_type}}</td>
                  <td>{{$flights->from}}</td>
                  <td>{{$flights->to}}</td>
                  <td>{{$flights->departure_date->format('m/d/Y')}}</td>
                  <td>{{$flights->time}}</td>
                  <td>{{$flights->arrival_date->format('m/d/Y')}}</td>
                  <td>₹{{$flights->price}}</td>
                  <td>{{$flights->available_seats - $flights->used_seats()}}</td>
                  <td>
                    <a href="{{ route('admin.flights.edit', $flights->id) }}" class="btn btn-success btn-sm">EDIT</a>
                  </td>
                  <td>
                    <form action="{{ route('admin.flights.destroy', $flights->id) }}" method="POST">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger btn-sm">DELETE</button>
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
              {{$flight->links()}}
          </div>
        </div>
      </div>
    </div>

@endsection

@section('script')
    
    <script>

        $(".date").datepicker({
          numberOfMonths: 1,
          changeYear: true,
          changeMonth: true,
          showOtherMonths: true,
          minDate: new Date(2019,10,20), // 10 means Nov cause Jan started with 0,
        });

    </script>

@endsection