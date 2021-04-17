@section('title','All Transactions')
@extends('layouts.title')

@section('content')

    <div class="container">


        <table class="table mt-5">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Bus Name</th>
                <th scope="col">Seats Num</th>
                <th scope="col">Total Price</th>
                <th scope="col">Booked Date</th>
            </tr>
            </thead>
            <tbody>
            @php ($count = 1)
            @forelse ($reports as $report)

                <tr>
                    <td>
                        <a href="{{url('profile/report/'.Crypt::encrypt($report->id))}}" class="text-info font-weight-bold">
                            {{$count++}}
                        </a>
                    </td>
                    <td>
                        <a href="{{url('profile/report/'.Crypt::encrypt($report->id))}}" class="text-info font-weight-bold">
                            {{$report->bus->name}}
                        </a>
                    </td>
                    <td> {{$report->seats_num}} </td>
                    <td> {{$report->total_price}} </td>
                    <td> {{$report->booked_date}} </td>



                </tr>

            @empty
                <tr>
                    <td></td>
                    <td>
                        <h3 class="text-danger">No transaction history found!</h3>
                    </td>
                </tr>

            @endforelse

        </table>
    </div>




@endsection

