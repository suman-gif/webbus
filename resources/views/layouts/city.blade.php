<div class="form-group row">
    <label for="from_location" class="col-md-4 col-form-label text-md-right">{{ __('From') }}<span class="required"> *</span></label>

    <div class="col-md-6">
		   <select name="from_location" id="from_location" class="form-control @error('from_location') is-invalid @enderror" required autocomplete="from_location" >
              <option value="">--Select Location--</option>
              <option value="Dharan">Dharan</option>
              <option value="Itahari">Itahari</option>
              <option value="Biratnagar">Biratnagar</option>
              <option value="Damak">Damak</option>
            </select>


        @error('from_location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

 <div class="form-group row">
    <label for="to_location"  class="col-md-4 col-form-label text-md-right">{{ __('To') }}<span class="required"> *</span></label>

    <div class="col-md-6">
		   <select name="to_location" id="to_location" class="form-control @error('to_location') is-invalid @enderror" required autocomplete="to_location">
              <option value="">--Select Location--</option>
              <option value="Dharan">Dharan</option>
              <option value="Itahari">Itahari</option>
              <option value="Biratnagar">Biratnagar</option>
              <option value="Damak">Damak</option>
            </select>


        @error('to_location')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
