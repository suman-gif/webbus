@section('title','Home')
@extends('layouts.app')

@section('content')

    <div id="demo" class="carousel slide" data-ride="carousel" style="margin-top: -50px;">

        <!-- Indicators -->
        <!--   <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
          </ul> -->

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('/assets/images/banner2.jpg') }}" width="1200" height="550">
            </div>


        </div>

        <!-- Left and right controls -->
        <!-- <a class="carousel-control-prev" href="#demo" data-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
          <span class="carousel-control-next-icon"></span>
        </a> -->
    </div>


    <div class="container  mt-3">
        <div class="row">
            <div class="col-sm-6">
                <!-- Default form login -->
                <form class="border border-light p-5" onsubmit="return from_to();" action="{{ route('available_bus') }}"
                      method="post">

                    {{ csrf_field() }}
                    <h3 class="mb-4">Select route</h3>


                    @include('layouts.city')


                    <div class="form-group row">
                        <label for="travel_date" class="col-md-4 col-form-label text-md-right">{{ __('Travel Date') }}
                            <span class="required"> *</span></label>

                        <div class="col-md-6">

                            <input type="text" id="nepali-datepicker"
                                   class="form-control mb-4 @error('travel_date') is-invalid @enderror"
                                   placeholder="Select Date" name="travel_date" required/>

                            <input type="hidden" id="travel_day" name="travel_day">

                            @error('travel_date')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6">
                            <!-- Sign in button -->
                            <button class="btn btn-info btn-block text-center" type="submit">Search</button>
                        </div>
                    </div>


                </form>
                <!-- Default form login -->
            </div>


            <div class="col-sm-4 mt-5 ml-5">
                <h3>Why Yatri BUS?</h3>

                <div class="list-group-flush">
                    <div class="list-group-item">
                        <p class="mb-0"><i class="far fa-clock fa-2x mr-2"></i>
                            Quick and Easy</p>
                    </div>
                    <div class="list-group-item">
                        <p class="mb-0"><i class="fas fa-clipboard-list fa-2x ml-1 mr-3" aria-hidden="true"></i>Plenty
                            of choices</p>
                    </div>
                    <div class="list-group-item">
                        <p class="mb-0"><i class="fab fa-angellist fa-2x mr-3" aria-hidden="true"></i>Unbeatable prices
                        </p>
                        <!-- </div> -->
                    </div>

                </div>
            </div>
        </div>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Want to know more about us?</h1>
                    <button class="btn btn-info"><a href="{{ url('contact') }}" class="text-white text-decoration-none">Contact
                            us </a></button>
                </div>
            </div>
        </div>


        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {



                var mainInput = document.getElementById("nepali-datepicker");

                today_date = NepaliFunctions.GetCurrentBsDate();
                mainInput.nepaliDatePicker({
                    disableBefore: today_date,
                    onChange: function () {
                        $('#travel_day').val(day_extract)
                    }
                });


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


                function day_extract() {
                    var Bsdate = document.getElementById('nepali-datepicker').value;

                    var fomated_Bsdate = NepaliFunctions.ConvertToDateObject(Bsdate, "YYYY-MM-DD")

                    var Addate = NepaliFunctions.BS2AD(fomated_Bsdate);

                    var AdDay = NepaliFunctions.GetAdFullDay(Addate);

                    return AdDay;
                };

                // Initialize select2

                $("#from_location").select2();
                $("#to_location").select2();


            });

        </script>
@endsection
