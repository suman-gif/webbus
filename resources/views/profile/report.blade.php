@section('title','My Profile')
@extends('layouts.title')

@section('content')

    <div class="container">
        @if (session('success_msg'))

            <div class="alert alert-success" role="alert">
                {{ session('success_msg') }}
            </div>

        @endif

        <a href="{{ url('/profile/reports') }}" class="btn btn-warning">All Transaction</a>

        <div class="row">


            <div class="col-sm-8">

                <table class="table mt-5">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="20%">Bus Regd. No.</th>
                        <td>{{$report->bus->reg_num}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Bus Name</th>
                        <td>{{$report->bus->name}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Seat Number</th>
                        <td>{{$report->seats_num}}</td>
                    </tr>
                    <tr>
                        <th scope="col">Total Price (in Rs.) </th>
                        <td>{{$report->total_price}}</td>
                    </tr>

                    <tr>
                        <th scope="col">Booked Date</th>
                        <td>{{ $report->booked_date }}</td>
                    </tr>
                    <tr>
                        <th scope="col">Transaction Date</th>
                        <td id="created_at"></td>
                    </tr>


                    </thead>


                </table>
            </div>


            <div class="col-sm-4 mt-5">

                <a href="{{ url('profile')}}/{{$report->user->id}}/edit"><button class="btn btn-outline-danger ">Request Cancel</button></a> <br>

            </div>

        </div>



    </div>

    <script type="text/javascript">
        $(document).ready(function () {

        function AD_to_BS(){
            var Addate = '<?php echo $report->created_at->todatestring(); ?>';

            var fomated_Addate = NepaliFunctions.ConvertToDateObject(Addate, "YYYY-MM-DD")

            var Bsdate = NepaliFunctions.AD2BS(fomated_Addate);
            $fin = NepaliFunctions.ConvertDateFormat(Bsdate)
            return $fin;
        }
        $('#created_at').text(AD_to_BS);



        });
    </script>

@endsection

