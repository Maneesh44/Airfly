@extends('layouts.app')

@section('content')
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
	  	<div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<form id="creditForm">
		  @csrf
		  <div class="modal-body">
			{{-- <label for="card">Accepted Cards</label>
			<div id="card" class="">
				<i class="fa fa-cc-visa" style="color:navy;"></i>
				<i class="fa fa-cc-amex" style="color:blue;"></i>
				<i class="fa fa-cc-mastercard" style="color:red;"></i>
				<i class="fa fa-cc-discover" style="color:orange;"></i>
			</div> --}}
			<div class="form-group">
				<label for="cname" class="col-form-label">Name on Card</label>
				<input type="text" class="form-control" id="cname" name="cname" placeholder="John More Doe">
			</div>
			<div class="form-group">
				<label for="ccnum" class="col-form-label">Credit card number</label>
				<input type="text" class="form-control" id="ccnum" name="ccnum" placeholder="1111-2222-3333-4444">
			</div>
			<div class="form-group">
				<label for="expdate" class="col-form-label">Exp Date</label>
				<input type="text" class="form-control date" id="expdate" name="expdate" placeholder="MM/DD/YYYY">
			</div>
			<div class="form-group">
				<label for="cvv" class="col-form-label">CVV</label>
				<input type="text" class="form-control" id="cvv" name="cvv" placeholder="985">
			</div>
			<div class="alert alert-danger print-error-msg" style="display:none">
        		<ul></ul>
    		</div>
		  </div>	  
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-info">Submit</button>
		  </div>
		</form>
		</div>
		</div>
  	</div>
	<header id="gtco-header" class="gtco-cover gtco-cover-md" role="banner" style="background-image: url(images/img_bg_2.jpg)">
		<div class="overlay"></div>
		<div class="gtco-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					

					<div class="row row-mt-15em" id="main-contain">
						<div class="col-md-5 mt-text animate-box" data-animate-effect="fadeInUp">
							<h1>Planing Trip To Anywhere in The World?</h1>
						</div>

						@auth
						<div class="col-md-7  animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="tab">
									
									<div class="tab-content">
										<div class="tab-content-inner active" data-content="signup">
											<h3>Book Your Trip</h3>
											<form class="probootstrap-form" id="BookingForm">
												
												{{-- <p class="alert alert-success" id="success"></p> --}}
												<input type="hidden" id="flight_id" display="none" name="flight_id">
												<input type="hidden" name="credit_id" id="creditId" display="none">
												<div class="form-group">
													<div class="front-container mb-3">
														{{-- AIRLINE TYPE --}}
														<div class="col-md">
															<div class="form-group">
																<label for="id_label_single2">Airline Type</label>
																<div class="probootstrap_select-wrap">
																<select class="js-example-basic-single js-states form-control dynamic" data-dependent="from" name="airline_type" style="width: 100%;" id="airline_type" >
																	<option value="">Select from</option>
																	@foreach ($airline_types as $airline_type)
																		<option value="{{$airline_type->airline_type}}">{{$airline_type->airline_type}}</option>
																	@endforeach														
																</select>
																</div>
															</div>
															</div>
															
														{{-- from --}}
														<div class="col-md">
														<div class="form-group">
															<label for="id_label_single2">From</label>
															<div class="probootstrap_select-wrap">
															<select class="js-example-basic-single js-states form-control dynamic" data-dependent="to" name="from" style="width: 100%;" id="from" >
																<option value="">Select from</option>
																													
															</select>
															</div>
														</div>
														</div>
														{{-- to --}}
														<div class="col-md">
															<div class="form-group">
																<label for="id_label_single2">To</label>
																<div class="probootstrap_select-wrap">
																<select class="js-example-basic-single js-states form-control" name="to" style="width: 100%;" id="to" >
																	<option value="">Select to</option>	
																														
																</select>
																</div>
															</div>
														</div>
														{{-- departure date --}}
														<div class="col-md">
															<div class="form-group">
																<label for="traveldate" class="col-form-label">Departure Date</label>
																<input type="text" class="form-control date" id="departdate" name="expdate" placeholder="MM/DD/YYYY">
															</div>
														</div>
														
														<div class="col-md">

															<!-- <button type="button" class="btn btn-primary btn-block" id="Book">Book</button> -->

															<button id="search" type="button" class="btn btn-info btn-block">Search</button>
															{{-- <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal">Book Now</button> --}}
														</div>
														
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							
						</div>
						
						@endauth

						@guest
						<div class="col-md-7  animate-box" data-animate-effect="fadeInRight">
							<div class="form-wrap">
								<div class="home-button" style="background: url('{{ asset('img/hoem.jpg') }}')">
									<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
								</div>
							</div>
						</div>
						
						@endguest

						
					</div>
					<div id="search-container"></div>
				</div>
			</div>
		</div>
	</header>
	
	
@endsection



@section('script')

<script>
    $('#search').click(function () {
        if ($('#airline_type').val() != '' && $('#from').val() != '' && $('#to').val() != '' && $('#departdate').val() != '') {
            // var select = $(this).attr('id');
            var airline_type = $('#airline_type').val();
            var from_val = $('#from').val();
            var to_val = $('#to').val();
            var departdate_val = $('#departdate').val();
            // var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('index.search') }}",
                method: "post",
                data: {
                    airline_type: airline_type,
                    from_val: from_val,
                    _token: _token,
                    to_val: to_val,
                    departdate_val: departdate_val
                },
                success: function (result) {
					$('#search-container').slideDown();
                    $('#search-container').html(result);
					$('#search-container').append('<div id="back">&#8592; Back</div>');
					$('#main-contain').slideUp();
					$('#back').click(function () {
						$('#main-contain').slideDown();
						$('#search-container').slideUp();

					});
					$('.flight-radio').on('click', function () {
        let flight_id = $(this).val();
		$('#book-now').fadeIn();


        console.log('Test');
        $('#flight_id').val(flight_id);


    });

                }
            });
        };
    });


    $('.dynamic').change(function () {
        if ($(this).val() != '') {
            var select = $(this).attr('id');
            var value = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('index.fetch') }}",
                method: "post",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function (result) {
                    $('#' + dependent).html(result);
                }
            });
        };
    });

    
    // $('#departure_date').on('change', function () {
    // 	let departure_date = $(this).val();
    // 	let to = $('#to').val();
    // 	let from = $('#from').val();
    // 	$.get('{{ route("returnFlight") }}?from='+from+'&to='+to+'&departure_date='+departure_date, function(res){

    // 		$('#flight_id').val(res.id);
    // 	})

    // });




    $('#creditForm').submit(function (e) {

        $.ajax({
            url: "{{ route('store') }}",
            method: 'POST',
            data: {
                _token: $("input[name='_token']").val(),
                'cname': $('#cname').val(),
                'ccnum': $('#ccnum').val(),
                'expdate': $('#expdate').val(),
                'cvv': $('#cvv').val(),
                'flight_id': $('#flight_id').val()
            },
            dataType: 'json',
            success: function (data) {

                $('#exampleModal').modal('hide');

                $('#from').val('');
                $('#to').val('');
                $('#departure_date').val('');
                $('#time').val('');
                $('#arrival_date').val('');
                $('#price').val('');

                alert('click ok to save your flight successfully');

            },

            error: function (err) {

                if (err.status == 422) {

                    printErrorMsg(err.responseJSON.errors);
                }
            }

        });


        e.preventDefault();

    });


    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');


        for (let prop in msg) {
            $(".print-error-msg").find("ul").append('<li>' + msg[prop] + '</li>');
        }
    }



    // datepicker.....jquery-ui
    $(".date").datepicker({
        numberOfMonths: 1,
        changeYear: true,
        changeMonth: true,
        showOtherMonths: true,
        minDate: new Date(2019, 10, 20), // 10 means Nov cause Jan started with 0,
    });

</script>
	
	 
 @endsection