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


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-green" data-toggle="modal" data-target="#exampleModal">
                    Confirm
                </button>
                <br>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body d-flex m-auto">
                                <form action="{{url('payment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="all_seat_info" value="{{json_encode($request->except(["_token"]),TRUE)}}">
                                    <input type="image" src="{{ asset('/assets/images/esewa.png') }}" alt="Submit" width="150">
                                </form>
                                <form action="{{url('payment')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="all_seat_info" value="{{json_encode($request->except(["_token"]),TRUE)}}">
                                    <input type="image" src="{{ asset('/assets/images/khalti.png') }}" alt="Submit" width="150">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/') }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to cancel?');">&nbsp;Cancel&nbsp;</a>




            </div>
        </div>

    </div>
@endsection
