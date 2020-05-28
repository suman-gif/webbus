<?php 
    $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
 
    foreach($days as $day){

?>

                                  
    <div class="custom-control custom-checkbox" >
        <input type="checkbox" name="off_day[]" class="custom-control-input @error('off_day[]') is-invalid @enderror" id="{{ $day }}" value="{{ $day }}">
        <label class="custom-control-label" for="{{ $day }}">{{ $day }}</label>    
    </div>     

<?php } ?>    