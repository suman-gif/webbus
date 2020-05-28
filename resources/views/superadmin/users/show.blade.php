@section('title','Bus Details')
@extends('layouts.title')

@section('content')

<div class="container">
	@if (session('success_msg'))

		<div class="alert alert-success" role="alert">
		  {{ session('success_msg') }}
		</div>

	@endif

		<a href="{{ url('superadmin/users') }}" class="btn btn-warning">Back</a>

		<a href="{{ url('superadmin/users/'.$user->id.'/busses') }}" class="btn btn-info">User's Busses</a>

	<div class="row">
		

		<div class="col-sm-8">
		
			<table class="table mt-5">
			  <thead class="thead-light">
			    <tr>
			      <th scope="col" width="20%">Id</th>
			      <td>{{$user->id}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Name</th>
			      <td>{{$user->name}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Username</th>
			      <td>{{$user->username}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Email</th>
			      <td>{{$user->email}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Address</th>
			      <td>{{$user->address}}</td>
			    </tr>
			    <tr>
			      <th scope="col">City</th>
			      <td>{{$user->city}}</td>
			    </tr>
			    <tr>
			      <th scope="col">District</th>
			      <td>{{$user->district}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Phone</th>
			      <td>{{$user->phone}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Registered At</th>
			      <td>{{$user->created_at}}</td>
			    </tr> 
			    
			  </thead>
			  
			   
			</table>
		</div>

		<div class="col-sm-4 mt-5">

			<p class="mt-3 text-capitalize">Current Role: 
				@if ($user->role_id==3)
					<strong> <span class="text-primary">{{$user->role->name}}</span> </strong>
				@elseif ($user->role_id==2)
					<strong> <span class="text-secondary">{{$user->role->name}}</span> </strong>
				@endif

			</p>


			<p class="float-left mt-3 mr-2">Set Role:</p>
		<!-- Set admin -->
			<form action="{{ url('superadmin/users/'.$user->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to make admin?');" class="float-left">

		  	 <!-- or blank action as it is the same page -->
				@csrf
				@method('PATCH')
				<button class="btn btn-secondary">Admin</button>
			</form>
		
			
		<!-- set customer -->
		  <form action="{{ url('superadmin/users/'.$user->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to make user?');">

		  	 <!-- or blank action as it is the same page -->
				@csrf
				@method('DELETE')
				<button class="btn btn-primary">Customer</button>
			</form>
			

		
		</div>
	</div>



</div>

<script>
</script>

@endsection

