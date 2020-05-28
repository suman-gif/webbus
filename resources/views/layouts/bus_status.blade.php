@if ($bus->status=='pending')
	<strong> <span class="text-warning">{{$bus->status}}</span> </strong>
@elseif ($bus->status=='rejected')
	<strong> <span class="text-danger">{{$bus->status}}</span> </strong>
@elseif($bus->status=='approved')
	<strong> <span class="text-success">{{$bus->status}}</span> </strong>
@endif