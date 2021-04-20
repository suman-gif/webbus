@section('title','My Profile')
@extends('layouts.title')

@section('content')

    <div class="container">
        @if (session('success_msg'))

            <div class="alert alert-success" role="alert">
                {{ session('success_msg') }}
            </div>

        @endif

        <a href="{{ url('/profile/reports') }}" class="btn btn-primary">All Transaction</a>

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

            @if  ($report->status=="Active")
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">
                    Request Cancel/Refund
                </button>
                @endif
                <div class="m-2">
                    <p>Status: <span class="font-weight-bold"> {{ $report->status }} </span></p>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Booking Cancellation Request Form</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.report.cancel') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="report_id" value="{{ $report->id }}">

                                    <label for="reason">{{ __('Reason') }}<span
                                            class="required">*</span></label>
                                    <textarea id="reason" type="text"
                                           class="form-control" name="reason" required autofocus cols="15" rows="5"></textarea>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

