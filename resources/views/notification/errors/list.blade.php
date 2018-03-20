@if (count($errors) > 0)
	<div class="alert-notification alert alert-danger alert-dismissible fade show" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	    <ul class="auth-notification">
	        @foreach ($errors->all() as $error)
	            <li><small><i class="fa fa-exclamation" aria-hidden="true"></i> {!! $error !!}</small></li>
	        @endforeach
	    </ul>
	</div>
@endif