@if(count($errors) > 0)
  	@foreach($errors->get($field) as $error)
	  	<div class="card-panel red lighten-4">
	    	<span>{!! $error !!}</span>
	    </div>
    @endforeach
@endif