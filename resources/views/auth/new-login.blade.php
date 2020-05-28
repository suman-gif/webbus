@section('title','Login')
@include('layouts.head')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">



<div class="custom-login"> </div>



<div aria-live="polite" aria-atomic="true" >
  <!-- Position it -->
  <div style="position: absolute; top: 0; right: 0;" >


@if ($errors->any())

@foreach ($errors->all() as $error)

    <!-- Then put toasts within -->
    <div class="toast mt-2 mr-1 border-0 d-flex bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-delay="4000">
      
      <div class="toast-body bg-danger text-white">
        {{ $error }}
      </div>
      <div class="toast-header bg-danger">
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>

@endforeach

@endif

    

  
  </div>
</div>
		
	<div class="login-body">
		<div class="logo"> 
			<img src="{{ asset('/assets/images/logo.png') }}" alt="Web Bus Login" title="Web Bus Logo" width="100px" class="pt-3">


                <div class="card-body">
					<form method="POST"  action="{{ route('login') }}">
						@csrf
						<div class="form-group">
							<i class="fa fa-user"></i>
							<input id="username" type="text" class="form-control pl-4" name="username" value="{{ old('username') }}" autocomplete="username" autofocus placeholder="Username">

                            

						</div>


						<div class="form-group">
							<i class="fa fa-lock"></i>
                                <input id="password" type="password" class="form-control pl-4" name="password" autocomplete="current-password" placeholder="Password">

                              
                        </div>

						<div class="form-group row pl-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

						<div class="form-group">
                            <button type="submit" class="btn btn-primary  w-100 m-0">
                                {{ __('Login') }}
                            </button>

                         
                        </div>
                        
                        <div class="form-group">
                        	   @if (Route::has('password.request'))
                                    <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
					

						<div class="modal-footer">
							Don't have account? <a href="{{ route('register') }}" class="text-primary"> Sign up here</a>
						</div>



					</form>

				</div>

			</div>
		</div>
	</div>
	
	

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>
    $('.toast').toast('show');

</script>