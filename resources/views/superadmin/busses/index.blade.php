@section('title','All Busses')
@extends('layouts.title')


@section('content')



	<div class="container">
		 @if (session('success_msg'))
			<div class="alert alert-success alert-dismissible fade show" role="alert">

			          {{ session('success_msg') }}      

			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
		@endif
			<!-- Basic dropdown -->
		<form action="{{ route('superadmin.busses.mass_status') }}" onsubmit="return check_mark();" method="post">
			@csrf
			<select class="browser-default custom-select w-25" name="status_mark">
			  <option selected value="null" disabled>Mark selected item as</option>
			  <option value="approved">Approve</option>
			  <option value="rejected">Reject</option> 
			  <option value="" disabled="">-------------------------------------------------------</option>
			  <option value="pending">Pending</option>
			</select>

			<button class="btn btn-success">Apply</button>

			<!-- Basic dropdown -->

		<table class="table mt-5">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Mark</th>
		      <th scope="col">Name</th>
		      <th scope="col">Added by</th>
		      <th scope="col">Regd. No.</th>
		      <th scope="col">From</th>
		      <th scope="col">To</th>
		      <th scope="col">Off Day</th>
		      <th scope="col">No. of Seats</th>
		      <th scope="col">Status</th>
		    </tr>
		  </thead>
		  <tbody>
		  	
			@forelse ($busses as $bus)
		  		
			    <tr>
			      <th scope="row"> {{$bus->id}} </th>
			      <th scope="row"> 
						<!-- Default unchecked -->
						<div class="custom-control custom-checkbox ml-2">
						    <input type="checkbox" class="custom-control-input" name="status[{{$bus->id}}]" id="status{{$bus->id}}">
						    <label class="custom-control-label" for="status{{$bus->id}}"></label>

						</div>
			       </th>
			      <td> <a href="busses/{{$bus->id}}" class="text-info font-weight-bold">{{$bus->name}}</a>  </td>
			      <td> {{$bus->user->name}} </td>
			      <td> {{$bus->reg_num}} </td>
			      <td> {{$bus->from_location}} </td>
			      <td> {{$bus->to_location}} </td>
			      <td> {{$bus->off_day}} </td>
			      <td> {{$bus->seat_num}} </td>


			      <td class="text-capitalize"> 
			     
					@include('layouts.bus_status')
				 </td>
		


			    </tr>

				@empty
					<tr>	
						<td></td>
						<td>
							<h3 class="text-danger">No bus found!</h3>
						</td>
					</tr>

			@endforelse

		</form>
		   
		</table>
	</div>

<script>
	function check_mark(){
		if( $('.custom-control-input'). is(":checked") ){

			 if($('.custom-select').val()=="null"){
				alert('Please select status.');
				return false;
			}
			
		}else{
			alert('Please select atleast one bus.');
			return false;
		}

	}
</script>


@endsection

