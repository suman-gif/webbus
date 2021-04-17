@section('title','Bus Report of 'git )
@extends('layouts.title')

@section('content')

    <div class="container">

        <table class="table mt-5 text-center">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Booked Date</th>
                <th scope="col">Bus Name</th>
                <th scope="col">Booked Seats Num</th>
                <th scope="col">Available Seats No.</th>
                <th scope="col">Per Ticket Price</th>
                <th scope="col">Total Earning</th>
            </tr>
            </thead>
            <tbody>
            @php ($count = 1)
            @forelse ($bus_report as $report)

                <tr>
                    <td>  {{$count++}} </td>
                    <td class="font-weight-bold"> {{$report->booked_date}} </td>
                    <td> {{$report->bus->name}} </td>
                    <td>
                        <?php
                        $booked_seats = explode(',', $report->booked_seats_num);
                        $booked_seat_count = count($booked_seats);
                        ?>
                        {{$report->booked_seats_num}} <span class="font-weight-bold"> ({{$booked_seat_count }})</span>

                    </td>

                    <td> {{$report->bus->seat_num - $booked_seat_count}} </td>
                    <td> Rs. {{$report->bus->price}} </td>
                    <td> Rs. {{ $report->bus->price*$booked_seat_count }} </td>
                </tr>

            @empty
                <tr>
                    <td></td>
                    <td>
                        <h3 class="text-danger">No history found!</h3>
                    </td>
                </tr>

            @endforelse

        </table>
    </div>

@endsection

