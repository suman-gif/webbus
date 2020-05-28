@section('title','Holidays of '.$bus->name)
@extends('layouts.title')


@section('content')

	<div class="container">
		
		<a href="{{  url()->previous()  }}" class="btn btn-warning">Back</a>
		<a href="{{ url('admin/holidays/')}}/{{$bus->id}}/create" class="btn btn-info pull-right">Add New Holiday</a>

		<table class="table mt-5">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">From</th>
		      <th scope="col">To</th>
		      <th scope="col">Description</th>
		      <th scope="col">Created at</th>
		    </tr>
		  </thead>
		  <tbody>
		  	
			@forelse ($holidays as $holiday)
		  		
			    <tr>
			     	<td> {{ $holiday->id }} </td>
			     	<td> {{ $holiday->date_from }} </td>
			     	<td> {{ $holiday->date_to }} </td>
			     	<td> {{ $holiday->description }} </td>
			     	<td> {{ $holiday->created_at }} </td>


			    </tr>

				@empty
					<tr>	
						<td></td>
						<td>
							<h3 class="text-danger">No holiday found for {{ $bus->name }} !</h3>
						</td>
					</tr>

			@endforelse
		   
		</table>
	</div>




@endsection

