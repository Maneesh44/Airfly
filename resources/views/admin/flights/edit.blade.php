@extends('layouts.master')

@section('name')
    Flight Edit
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Flight</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form class="form-group" action="{{ route('admin.flights.update', $flight->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label>AIRLINE TYPE (AIRLINE / HELICOPTER)</label>
                                <input type="text" name="airline_type" value="{{ $flight->airline_type }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>AIRLINE NAME</label>
                                <input type="text" name="airline_name" value="{{ $flight->airline_name }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>FROM</label>
                                <input type="text" name="from" value="{{ $flight->from }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>TO</label>
                                <input type="text" name="to" value="{{ $flight->to }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>DEPARTURE DATE</label>
                                <input type="text" id="departure_date" name="departure_date" value="{{ $flight->departure_date->format('m/d/Y') }}" class="form-control date" placeholder="MM/DD/YYYY">
                            </div>
                            <div class="form-group">
                                <label>TIME</label>
                                <input type="text" name="time" value="{{ $flight->time }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>ARRIVAL DATE</label>
                                <input type="text" id="arrival_date" name="arrival_date" value="{{ $flight->arrival_date->format('m/d/Y') }}" class="form-control date" placeholder="MM/DD/YYYY">
                            </div>
                            <div class="form-group">
                                <label>PRICE</label>
                                <input type="text" name="price" value="{{ $flight->price }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>AVAILABLE SEATS</label>
                                <input type="text" name="available_seats" value="{{ $flight->available_seats }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success float-left">Update</button>
                        </form>
                        <form class="form-group" action="{{ route('admin.flights.index')}}" method="post">
                            @csrf
                            @method('get')
                            <button type="submit" class="btn btn-danger float-right">Cancel</button>
                        </form>
                    </div>
                </div>
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
          minDate: new Date(2019,10,20), // 10 means Nov cause Jan started with 0
        });

    </script>

@endsection