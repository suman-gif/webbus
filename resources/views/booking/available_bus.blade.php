@section('title','Available Busses')
@extends('layouts.title')

@section('content')

	<div class="container">


	<p >Selected Date: <span id="travel_date"> {{$travel_date}}</span></p>		

		<table class="table mt-5">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Name</th>
		      <th scope="col">Regd. No.</th>
		      <th scope="col">From</th>
		      <th scope="col">To</th>
		      <th scope="col">Departure Time</th>
		      <th scope="col">Arrival Time</th>

		      <th scope="col">Price (in Rs.) </th>

		      <th scope="col">Available No. of Seats</th>
		    </tr>
		  </thead>
		  <tbody>
		  	

			@forelse ($busses as $bus)
		  		
				    <tr>
					      <th scope="row"> {{$bus->id}} </th>
					      <td> <a href="busses/{{$bus->id}}" class="text-info font-weight-bold">{{$bus->name}}</a>  </td>
					      <td> {{$bus->reg_num}} </td>
					      <td class="text-capitalize"> {{$bus->from_location}} </td>
					      <td class="text-capitalize"> {{$bus->to_location}} </td>
					      <td> {{$bus->start_time}} </td>
					      <td> {{$bus->time_to_reach}} </td>
					      <td class="text-success font-weight-bold"> {{$bus->price}} </td>
					      <td> {{$bus->seat_num}} </td>

					   

				   	  </tr>

				@empty
					<tr>	
						<td></td>
						<td>
							<h3 class="text-danger">No bus found!</h3>
						</td>
					</tr>

			@endforelse
		   
		</table>
	</div>



@endsection

