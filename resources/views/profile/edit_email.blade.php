@section('title','Change Password')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> @if (session('error_msg'))

                    <div class="alert alert-danger" role="alert">
                      {{ session('error_msg') }}
                    </div>

                @endif
            <div class="card">

               
                <div class="card-header">{{ __('Update Email') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ url('/email/'.$user->id) }}" onsubmit="return same_email();">
                        @csrf
                        @method('Patch')

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Current Email') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" value="{{Auth::user()->email}}" disabled>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('New Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="new-email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email-confirm" class="col-md-4 col-form-label text-md-right">{{ __('New Confirm Email') }}</label>

                            <div class="col-md-6">
                                <input id="email-confirm" type="email" class="form-control" name="email_confirmation" required autocomplete="new-email">
                           

                                    <span class="invalid-feedback" role="alert" id="invalid_email">
                                        
                                    </span>
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>

                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function same_email() {
        var email = $('#email').val();
        var confirm_email = $('#email-confirm').val();

        if ( email == confirm_email ) {
            return true;
        }else{
            console.log(email+'...'+confirm_email);
            $('.invalid-feedback').show();
            $('#email-confirm').css("border", "red solid 1px"); 

            $('#invalid_email').html('<strong> Confirm email does not match with the new email. </strong>');
            return false;
        }
    }
</script>
@endsection
