@section('title','My Profile')
@extends('layouts.title')

@section('content')

<div class="container">
	@if (session('success_msg'))

		<div class="alert alert-success" role="alert">
		  {{ session('success_msg') }}
		</div>

	@endif

		<a href="{{ url('/') }}" class="btn btn-warning">Home</a>




	<div class="row">


		<div class="col-sm-8">

			<table class="table mt-5">
			  <thead class="thead-light">
			    <tr>
			      <th scope="col" width="20%">User id</th>
			      <td>{{$profile->id}}</td>
			    </tr>
			     <tr>
			      <th scope="col">User Role</th>
			      <td>{{$profile->role->name}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Name</th>
			      <td>{{$profile->name}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Username</th>
			      <td>{{$profile->username}}</td>
			    </tr>

			    <tr>
			      <th scope="col">E-Mail</th>
			      <td>{{$profile->email}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Phone</th>
			      <td>{{$profile->phone}}</td>
			    </tr>
			    <tr>
			      <th scope="col">District</th>
			      <td>{{$profile->district}}</td>
			    </tr>
			    <tr>
			      <th scope="col">City</th>
			      <td>{{$profile->city}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Address</th>
			      <td>{{$profile->address}}</td>
			    </tr>
			    <tr>
			      <th scope="col">Registered At</th>
			      <td>{{ $profile->created_at->todatestring() }}</td>
			    </tr>
			    <tr>
			      <th scope="col">Email Verified At</th>
			      <td>
						@if ( $profile->email_verified_at == NULL )
							<strong>Email not verified -> </strong>

							<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
		                       	@csrf

		                        <button type="submit" class="btn btn-link p-0">click here to resend email</button>
		                    </form>

						@else
							{{ $profile->email_verified_at->todatestring() }}
						@endif

			      </td>
			    </tr>

			  </thead>


			</table>
		</div>


		<div class="col-sm-4 mt-5">
			<a href="{{ url('profile')}}/{{$profile->id}}/edit"><button class="btn btn-outline-info ">Edit Profile</button></a> <br>
			<a href="{{ url('profile')}}/{{$profile->id}}/email"><button class="btn btn-outline-info ">Update Email</button></a>
			<a href="{{ url('profile')}}/{{$profile->id}}/password"><button class="btn btn-outline-info ">Update Password</button></a> <br>

		</div>

	</div>



</div>

<script>
</script>

@endsection

