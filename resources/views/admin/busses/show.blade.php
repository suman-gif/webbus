@section('title','Bus Details')
@extends('layouts.title')

@section('content')

<div class="container">
	@if (session('success_msg'))

		<div class="alert alert-success" role="alert">
		  {{ session('success_msg') }}
		</div>

	@endif

		<a href="{{ url('admin/busses') }}" class="btn btn-warning">Back</a>

		 <a href="{{ url('admin/holidays')}}/{{$bus->id}}" class="btn btn-danger"> See holidays </a>

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

			<a href="{{$bus->id}}/edit"><button class="btn btn-outline-primary">Update</button></a>

		  <form action="{{ url('admin/busses') }}/{{$bus->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete it?');">

		  	 <!-- or blank action as it is the same page -->
				@method('DELETE')
				@csrf
				<button class="btn btn-outline-danger">Delete</button>
			</form>

			<p class="text-capitalize">Status: 
				@include('layouts.bus_status')
			</p>

		</div>
	</div>



</div>

@endsection

