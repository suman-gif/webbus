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
		      <th scope="col">Off Day</th>
		      <th scope="col">No. of Seats</th>
		      <th scope="col">Holidays From</th>
		      <th scope="col">Holidays to</th>
		      <th scope="col">Status</th>
		    </tr>
		  </thead>
		  <tbody>
		  	

			@forelse ($busses as $bus)
		  		
				    <tr>
					      <th scope="row"> {{$bus->id}} </th>
					      <td> <a href="busses/{{$bus->id}}" class="text-info font-weight-bold">{{$bus->name}}</a>  </td>
					      <td> {{$bus->reg_num}} </td>
					      <td> {{$bus->from}} </td>
					      <td> {{$bus->to}} </td>
					      <td> {{$bus->off_day}} </td>
					      <td> {{$bus->seat_num}} </td>
					      <td> {{$bus->date_from}} </td>
					      <td> {{$bus->date_to}} </td>

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
		   
		</table>
	</div>



@endsection

