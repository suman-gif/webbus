@section('title','Busses')
@extends('layouts.title')

@section('content')

	<div class="container">

		
		
		<a href="{{ route('admin.busses.create') }}" class="btn btn-primary">Add New Bus</a>

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
		      <th scope="col">Holidays</th>
		      <th scope="col">Status</th>
		    </tr>
		  </thead>
		  <tbody>
		  	
			@forelse ($busses as $bus)
		  		
			    <tr>
			      <th scope="row"> {{$bus->id}} </th>
			      <td> <a href="busses/{{$bus->id}}" class="text-info font-weight-bold">{{$bus->name}}</a>  </td>
			      <td> {{$bus->reg_num}} </td>
			      <td> {{$bus->from_location}} </td>
			      <td> {{$bus->to_location}} </td>
			      <td> {{$bus->off_day}} </td>
			      <td> {{$bus->seat_num}} </td>
			      <td> 
		 				<a href="{{ url('admin/holidays')}}/{{$bus->id}}" class="text-danger"> See holidays </a> 
				  </td>

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

