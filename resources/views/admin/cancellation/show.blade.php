@section('title','Request Review')
@extends('layouts.title')

@section('content')

    <div class="container">
        @if (session('success_msg'))

            <div class="alert alert-success" role="alert">
                {{ session('success_msg') }}
            </div>

        @endif

        <a href="{{ url('/admin/cancellation') }}" class="btn btn-primary">All Cancellation Request</a>

        <div class="row">


            <div class="col-sm-8">

                <table class="table mt-5">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="20%">Reason</th>
                        <td class="text-danger font-weight-bold text-capitalize">{{$cancellation->reason}}</td>
                    </tr>

                    <tr>
                        <th scope="col" width="20%">User Id</th>
                        <td>{{$cancellation->user->id}}</td>
                    </tr>
                    <tr>
                        <th scope="col">User Name</th>
                        <td>{{$cancellation->user->name}}</td>
                    </tr>
                    <tr>
                        <th scope="col">User Email</th>
                        <td>{{$cancellation->user->email}}</td>
                    </tr>
                    <tr>
                        <th scope="col">User Phone</th>
                        <td>{{$cancellation->user->phone}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Seat Number</th>
                        <td>{{$cancellation->report->seats_num}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Total Price (in Rs.)</th>
                        <td>{{$cancellation->report->total_price}}</td>
                    </tr>

                    <tr>
                        <th scope="col">Booked Date</th>
                        <td>{{ $cancellation->report->booked_date }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Transaction Date</th>
                        <td id="created_at"></td>
                    </tr>


                    </thead>


                </table>
            </div>


            <div class="col-sm-4 mt-5">
                @if ($cancellation->report->status == "Pending Cancellation")
                <a href="{{ url('admin/cancellation/'.$cancellation->id.'/accept') }}" class="btn btn-outline-success"
                 onclick="return confirm('Are you sure you want to accept the request?')">
                    Accept
                </a>

                <a href="{{ url('admin/cancellation/'.$cancellation->id.'/reject') }}" class="btn btn-outline-danger"
                onclick="return confirm('Are you sure you want to reject?')">
                    Reject
                </a>
                @else
                    <p class="font-weight-bold">{{ $cancellation->report->status }}</p>
                @endif
            </div>


        </div>

        <script type="text/javascript">
            $(document).ready(function () {

                function AD_to_BS() {
                    var Addate = '<?php echo $cancellation->created_at->todatestring(); ?>';

                    var fomated_Addate = NepaliFunctions.ConvertToDateObject(Addate, "YYYY-MM-DD")

                    var Bsdate = NepaliFunctions.AD2BS(fomated_Addate);
                    $fin = NepaliFunctions.ConvertDateFormat(Bsdate)
                    return $fin;
                }

                $('#created_at').text(AD_to_BS);

            });
        </script>

@endsection

