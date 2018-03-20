@if (count($success) > 0)
	<div class="alert-notification alert alert-success alert-dismissible fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	    <ul class="auth-notification">
	        @foreach ($success->all() as $item)
	            <li><small><i class="fa fa-check" aria-hidden="true"></i> {!! $item !!}</small></li>
	        @endforeach
	    </ul>
	</div>
@endif