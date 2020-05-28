@section('title','Add New Holiday')


@extends('layouts.title')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Holiday of {{$bus->name}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.holidays.store') }}">
                        @csrf
        
        <input type="hidden" name="bus_id" value="{{$bus->id}}">
                        <div class="form-group row">
                            <label for="date_from" class="col-md-4 col-form-label text-md-right">{{ __('From') }}<span class="required"> *</span></label>

                            <div class="col-md-6">	
				                  <input type="text" id="nepali-datepicker" class="form-control mb-4  @error('date_from') is-invalid @enderror" name="date_from" placeholder="Select Date" required />

                                @error('date_from')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}<span class="required"> *</span></label>

                            <div class="col-md-6">	
				                  <input type="text" id="nepali-datepicker1" class="form-control mb-4  @error('date_to') is-invalid @enderror" name="date_to" placeholder="Select Date" required />

                                @error('date_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

						
						<div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                    
                                <textarea id="description"  class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" rows="5"  >{{ old('description') }}</textarea>
                                
                                
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Holiday') }}
                                </button>

                                <a href="{{ url('admin/holidays/'.$bus->id)}}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    window.onload = function () {
        var mainInput = document.getElementById("nepali-datepicker");
        var mainInput1 = document.getElementById("nepali-datepicker1");
       
        mainInput.nepaliDatePicker({
            dateFormat: "YYYY-MM-DD"
        }); 
        mainInput1.nepaliDatePicker({
            dateFormat: "YYYY-MM-DD"
        }); 

    };
</script>
