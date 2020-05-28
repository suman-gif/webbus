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
		<form action="{{ route('superadmin.users.mass_role') }}" onsubmit="return check_mark();" method="post">
			@csrf
			<select class="browser-default custom-select w-25" name="role_type">
			  <option selected value="null" readonly>Mark selected user as</option>
			  <option value="2">Admin</option>
			  <option value="3">Customer</option> 
			</select>

			<button class="btn btn-success">Apply</button>

			<!-- Basic dropdown -->

		<table class="table mt-5">
		  <thead class="thead-light">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Mark</th>
		      <th scope="col">Name</th>
		      <th scope="col">Username</th>
		      <th scope="col">Email</th>
		      <th scope="col">Address</th>
		      <th scope="col">City</th>
		      <th scope="col">Phone</th>
		      <th scope="col">Type</th>
		    </tr>
		  </thead>
		  <tbody>
		  	
			@forelse ($users as $user)
				@if ($user->role->id != 1)

		  		
			    <tr>
			      <th scope="row"> {{$user->id}} </th>
			      <th scope="row"> 
						<!-- Default unchecked -->
						<div class="custom-control custom-checkbox ml-2">
						    <input type="checkbox" class="custom-control-input" name="role[{{$user->id}}]" id="role{{$user->id}}">
						    <label class="custom-control-label" for="role{{$user->id}}"></label>

						</div>
			       </th>
			      <td> <a href="users/{{$user->id}}" class="text-info font-weight-bold">{{$user->name}}</a>  </td>
			      <td> {{$user->username}} </td>
			      <td> {{$user->email}} </td>
			      <td> {{$user->address}} </td>
			      <td> {{$user->city}} </td>
			      <td> {{$user->phone}} </td>


			      <td class="text-capitalize"> 
			      	@if ($user->role_id==3)
						<strong> <span class="text-primary">{{$user->role->name}}</span> </strong>
					@elseif ($user->role_id==2)
						<strong> <span class="text-secondary">{{$user->role->name}}</span> </strong>
					@endif

				 </td>
		

				@endif

			    </tr>

				@empty
					<tr>	
						<td></td>
						<td>
							<h3 class="text-danger">No user found!</h3>
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
				alert('Please select user type.');
				return false;
			}
			
		}else{
			alert('Please select atleast one user.');
			return false;
		}

	}
</script>


@endsection

