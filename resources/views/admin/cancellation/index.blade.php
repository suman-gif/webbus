@section('title','All Cancellation Request')
@extends('layouts.title')

@section('content')

    <div class="container">



        <a href="{{ url('/') }}" class="btn btn-primary">Home</a>

        <table class="table mt-5">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">User id</th>
                <th scope="col">User Name</th>
                <th scope="col">Bus Name</th>
                <th scope="col">Seats Num</th>
                <th scope="col">Total Price</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 0; ?>
            @forelse ($bus_report as $report)

                <tr>
                    <th scope="row"> {{ $count++ }} </th>
                    <td> <a href=" {{ url('admin/cancellation/'.$report->id) }} " class="font-weight-bold text-primary"> {{ $report->user->name }} </a>  </td>
                    <td> <a href=" {{ url('admin/cancellation/'.$report->id) }} " class="font-weight-bold text-primary"> {{ $report->user_id }} </a> </td>
                    <td> <a href=" {{ url('admin/cancellation/'.$report->id) }} " class="font-weight-bold text-primary"> {{ $report->bus->name }} </a> </td>
                    <td> {{ $report->report->seats_num }} </td>
                    <td> {{ $report->report->total_price }} </td>
                    <td class="font-weight-bold"> {{ $report->report->status }} </td>

                </tr>

            @empty
                <tr>
                    <td></td>
                    <td>
                        <h3 class="text-danger">No request found!</h3>
                    </td>
                </tr>

            @endforelse

        </table>
    </div>




@endsection

