@section('title','Edit Bus')
@extends('layouts.title')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bus Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('admin/busses') }}/{{$bus->id}}">
                        @method('Patch')
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}<span class="required"> *</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $bus->name }}" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reg_num" class="col-md-4 col-form-label text-md-right">{{ __('Registration No.') }}<span class="required"> *</span></label>

                            <div class="col-md-6">
                                <input id="reg_num" type="text" class="form-control @error('reg_num') is-invalid @enderror" autocomplete="off" name="reg_num" value="{{ $bus->reg_num }}" required >

                                @error('reg_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Fare (Price in Rs.)') }}<span class="required"> *</span></label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required autocomplete="new-price"  value="{{ $bus->price }}">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        @include('layouts.city_retrieve')

					    <div class="form-group row">
                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Time Bus will start') }}<span class="required"> *</span></label>

                            <div class="col-md-6">
                                <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" required autocomplete="start_time"  value="{{ $bus->start_time }}">



                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="time_to_reach" class="col-md-4 col-form-label text-md-right">{{ __('Estimated Time to reach') }}<span class="required"> *</span></label>

                            <div class="col-md-6">
                                <input id="time_to_reach" type="time" class="form-control @error('time_to_reach') is-invalid @enderror" name="time_to_reach" required autocomplete="time_to_reach"  value="{{ $bus->time_to_reach }}">



                                @error('time_to_reach')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                         <div class="form-group row">
                            <label for="off_day" class="col-md-4 col-form-label text-md-right">{{ __('Off Day') }}</label>

                            <div class="col-md-6">

                                @if ($bus->off_day)
                                    <input type="text" class="form-control show_btn" value="{{ $bus->off_day }}" id="set_disable" readonly>
                                    <a class="btn btn-success show_btn" onclick="show_days();"> Add New? </a>

                                <div id="add_offday">
                                    <?php
                                        $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

                                    $db_days = explode(", ",$bus->off_day);
                                    //print_r($db_days);

                                    //array intersect was easier. found later :D
                                        foreach($days as $day){
                                            $flag =0;
                                            foreach ($db_days as $value) {
                                                if($value == $day){
                                                    $flag = 1;
                                                }
                                            }
                                    ?>

                                      @if ($flag==1)
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" name="off_day[]" class="custom-control-input @error('off_day[]') is-invalid @enderror" id="{{ $day }}"  value="{{ $day }}" checked>
                                          <label class="custom-control-label" for="{{ $day }}">{{$day}}</label>
                                        </div>
                                      @else
                                        <div class="custom-control custom-checkbox" >
                                            <input type="checkbox" name="off_day[]" class="custom-control-input @error('off_day[]') is-invalid @enderror" id="{{ $day }}" value="{{ $day }}">
                                            <label class="custom-control-label" for="{{ $day }}">{{ $day }}</label>
                                        </div>
                                      @endif

                                    <?php } ?>
                                </div>
                                @else

                                    @include('layouts.days')

                                @endif
                                    @error('off_day[]')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="seat_num" class="col-md-4 col-form-label text-md-right">{{ __('No. of Seats') }}<span class="required"> *</span></label>

                            <div class="col-md-6">
                                <select name="seat_num" id="seat_num" class="form-control @error('seat_num') is-invalid @enderror" required>
                                    <option value="{{ $bus->seat_num }}">{{ $bus->seat_num }}</option>
                                    <option value="" disabled>----------------------------------------------------</option>                                    <option value="35">35</option>
                                    <option value="39">39</option>
                                    <option value="43">43</option>
                                    <option value="47">47</option>
                                </select>


                                @error('seat_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                         <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">

                                <textarea id="description"  class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" rows="5"  >{{ $bus->description }}</textarea>


                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="edit_bus_btn">
                                    {{ __('Update Bus') }}
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
@endsection

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

    function show_days() {
        $('#add_offday').show();
        $('.show_btn').hide();
        $('#set_disable').prop('disabled', true);
    }

        $('#edit_bus_btn').on('click',function(){
            var from = $('#select2-from_location-container').html();
            var to = $('#select2-to_location-container').html();
            if (from == to) {
                alert('From and To location cannot be same.');
                console.log(from + '...' + to);
                return false;
            } else {
                return true;
            }
        });

        // Initialize select2
        $("#from_location").select2();
        $("#to_location").select2();
</script>
