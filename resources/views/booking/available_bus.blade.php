@section('title','Available Busses')
@extends('layouts.title')

@section('content')

    <div class="container">


        <p>Selected Date: <span id="travel_date"> {{$travel_date}}</span></p>

        <table class="table mt-5">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Regd. No.</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Departure Time</th>
                <th scope="col">Arrival Time</th>

                <th scope="col">Price (in Rs.)</th>

                <th scope="col">Available Seats</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>


            @forelse ($busses as $bus)

                <tr>
                    <th scope="row"> {{$bus->id}} </th>
                    <td class="font-weight-bold text-danger"> {{$bus->name}} </td>
                    <td> {{$bus->reg_num}} </td>
                    <td> {{$bus->from_location}} </td>
                    <td> {{$bus->to_location}} </td>
                    <td> {{$bus->start_time}} </td>
                    <td> {{$bus->time_to_reach}} </td>
                    <td class="text-success font-weight-bold text-center"> {{$bus->price}} </td>
                    <td class="text-center"> {{$bus->seat_num}} </td>

                    <td class="pt-3">
                        <!-- Button trigger modal -->
                        <button onclick="load_seat_layout({{$bus->id}})" type="button" class="btn btn-sm btn-primary m-0" data-toggle="modal" data-target="#seatLayout">
                            Select Seat
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="seatLayout" tabindex="-1" role="dialog" aria-labelledby="seatLayoutLabel" aria-hidden="true">

                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">


                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="seatLayoutLabel">Select Seat</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body" id="modal-body">

                                    </div>

                                </div>
                            </div>
                        </div> </td>


                </tr>

            @empty
                <tr>
                    <td></td>
                    <td>
                        <h3 class="text-danger">No bus found!</h3>
                    </td>
                </tr>

            @endforelse

        </table>
    </div>


    <script type="text/javascript">

        var travel_date = $('#travel_date').html();
        function load_seat_layout(bus)
        {
            $('#modal-body').load('/get_seat_layout/'+bus);
        }



        $('#seatLayout').on('hidden.bs.modal', function () {
            unload_seat_layout();
        });

        function unload_seat_layout() {

            setTimeout(function() { $('#modal-body').empty(); }, 100);

        }


    </script>
@endsection

