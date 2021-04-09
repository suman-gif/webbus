@section('title','Checkout')
@extends('layouts.title')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-sm-8">
                <table class="table mt-5">
                    <thead class="thead-light">
                    <tr >
                        <th scope="col" width="20%" class="text-danger font-weight-bold">Selected seats</th>
                        <td class="text-danger font-weight-bold">{{$request->selected_seats_num}}</td>

                    </tr>
                    <tr>
                        <th scope="col" width="20%" class="text-danger font-weight-bold">Booking date</th>
                        <td class="text-danger font-weight-bold">{{$request->booked_date}}</td>
                    </tr>


                    <tr>
                        <th scope="col">Bus Name</th>
                        <td>{{$bus->name}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Regd. No.</th>
                        <td>{{$bus->reg_num}}</td>
                    </tr>
                    <tr>
                        <th scope="col">From</th>
                        <td>{{$bus->from_location}}</td>
                    </tr>
                    <tr>
                        <th scope="col">To</th>
                        <td>{{$bus->to_location}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Start Time</th>
                        <td>{{$bus->start_time}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Time to Reach</th>
                        <td>{{$bus->time_to_reach}}</td>
                    </tr>

                    </thead>


                </table>
            </div>

            <div class="col-sm-4 mt-5">
                <h5>Total Price: <span class="text-success  mt-5">Rs.{{ $request->total_price }} </span> </h5>

                <form action="{{url('payment')}}" method="POST">
                    @csrf
                    <input type="hidden" name="all_seat_info" value="{{json_encode($request->except(["_token"]),TRUE)}}">
                    <input type="submit" value="Confirm" class="btn btn-outline-primary">
                </form>

                <a href="{{ url('/') }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?');">&nbsp;Cancel&nbsp;</a>




            </div>
        </div>

    </div>
@endsection
