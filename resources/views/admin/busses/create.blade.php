@section('title','Add New Bus')
@extends('layouts.title')


@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bus Details') }}</div>

                    <div class="card-body">
                        <form method="POST" onsubmit="return from_to();" action="{{ route('admin.busses.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span
                                        class="required"> *</span></label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="reg_num"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Registration No.') }}<span
                                        class="required"> *</span></label>

                                <div class="col-md-6">
                                    <input id="reg_num" type="text"
                                           class="form-control @error('reg_num') is-invalid @enderror"
                                           autocomplete="reg_num" name="reg_num" value="{{ old('reg_num') }}" required>

                                    @error('reg_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Fare (Price in Rs.)') }}
                                    <span class="required"> *</span></label>

                                <div class="col-md-6">
                                    <input id="price" type="number"
                                           class="form-control @error('price') is-invalid @enderror" name="price"
                                           required autocomplete="new-price" value="{{ old('price') }}">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            @include('layouts.city')


                            <div class="form-group row">
                                <label for="start_time"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Time Bus will start') }}
                                    <span class="required"> *</span></label>

                                <div class="col-md-6">
                                    <input id="start_time" type="time"
                                           class="form-control @error('start_time') is-invalid @enderror"
                                           name="start_time" required autocomplete="start_time"
                                           value="{{ old('start_time') }}">


                                    @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="time_to_reach"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Estimated Time to reach') }}
                                    <span class="required"> *</span></label>

                                <div class="col-md-6">
                                    <input id="time_to_reach" type="time"
                                           class="form-control @error('time_to_reach') is-invalid @enderror"
                                           name="time_to_reach" required autocomplete="time_to_reach"
                                           value="{{ old('time_to_reach') }}">


                                    @error('time_to_reach')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="off_day"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Off Day') }}</label>

                                <div class="col-md-6">

                                    @include('layouts.days')

                                    @error('off_day[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="seat_num"
                                       class="col-md-4 col-form-label text-md-right">{{ __('No. of Seats') }}<span
                                        class="required"> *</span></label>

                                <div class="col-md-6">
                                    <input id="seat_num" type="number"
                                           class="form-control @error('seat_num') is-invalid @enderror" name="seat_num"
                                           required autocomplete="seat_num" value="{{ old('seat_num') }}">


                                    @error('seat_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">

                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" autocomplete="description"
                                              rows="5">{{ old('description') }}</textarea>


                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Bus') }}
                                    </button>

                                    <a href="{{ route('admin.busses.index') }}" class="btn btn-danger">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function () {

        function from_to() {
            var from = $('#from_location').val();
            var to = $('#to_location').val();

            if (from == to) {
                alert('From and To location cannot be same.');
                console.log(from + '...' + to);
                return false;
            } else {
                return true;
            }

        };

        // Initialize select2
        $("#from_location").select2();
        $("#to_location").select2();


        $('#start_time').timepicker({
            showInputs: false
        });
    });

</script>


@endsection

