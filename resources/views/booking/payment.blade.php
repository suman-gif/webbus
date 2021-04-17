@section('title','E-Payment')
@extends('layouts.title')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold">Payment Status</div>

                    <div class="card-body">
                        Payment successfully done with total amount of <span class="text-danger"> Rs.{{$selected_seat_info['total_price']}} </span>
                        with the ticket number of <span class="text-danger">  {{$selected_seat_info['selected_seats_num']}} </span>.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
