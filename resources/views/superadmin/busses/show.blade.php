@section('title','Bus Details')
@extends('layouts.title')

@section('content')

<div class="container">
	@if (session('success_msg'))

		<div class="alert alert-success" role="alert">
		  {{ session('success_msg') }}
		</div>

	@endif

		<a href="{{ url('superadmin/busses') }}" class="btn btn-warning">Back</a>

	<div class="row">
		

		<div class="col-sm-8">
		
			<table class="table mt-5">
			  <thead class="thead-light">
			    <tr>
			      <th scope="col" width="20%">Id</th>
			      <td>{{$bus->id}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Name</th>
			      <td>{{$bus->name}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Regd. No.</th>
			      <td>{{$bus->reg_num}}</td>
			    </tr>
			    <tr>
			      <th scope="col">From</th>
			      <td>{{$bus->from_location}}</td>
			    </tr>
			    <tr>
			      <th scope="col">To</th>
			      <td>{{$bus->to_location}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Start Time</th>
			      <td>{{$bus->start_time}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Time to Reach</th>
			      <td>{{$bus->time_to_reach}}</td>
			    </tr>
			    <tr>
			      <th scope="col">No. of Seats</th>
			      <td>{{$bus->seat_num}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Off Day</th>
			      <td>{{$bus->off_day}}</td>
			    </tr> 
			    <tr>
			      <th scope="col">Description</th>
			      <td>{{$bus->description}}</td>
			    </tr>
			    
			  </thead>
			  
			   
			</table>
		</div>

		<div class="col-sm-4 mt-5">
			<h5>Price: <span class="text-success  mt-5">Rs.{{ $bus->price }} </span> </h5>

		
			<form action="" method="POST" onsubmit="return confirm('Are you sure you want to approve it?');" class="float-left">

		  	 <!-- or blank action as it is the same page -->
				@csrf
				@method('PATCH')
				<button class="btn btn-success">Approve</button>
			</form>
		
			

		  <form action="{{ url('superadmin/busses') }}/{{$bus->id}}" method="POST" onsubmit="return confirm('Are you sure you want to reject it?');">

		  	 <!-- or blank action as it is the same page -->
				@method('PATCH')
				@csrf
				<button class="btn btn-danger">Reject</button>
			</form>
			

			<p class="mt-3 text-capitalize">Status: 
				
				@include('layouts.bus_status')
			</p>

		</div>
	</div>



</div>

<script>
</script>

@endsection

