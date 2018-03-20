@extends('auth.layout')

@section('content')
	<div class="container">
		<div class="outer">
			<div class="middle">
				<div class="login">
					<h2 class="login-header">Log in</h2>
					<form class="login-form" method="POST" action="{{ route('post_login') }}">
						@include('notification.errors.list')
						<p><input value="{{ old('name') }}" type="text" name="dealer" id="name" placeholder="Name"></p>
						<p><input type="password" name="password" id="password" placeholder="Password"></p>
						<p><button type="submit" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">Log in</button></p>
						{!! csrf_field() !!}
					</form>
				</div>
			</div>	
		</div>
	</div>
@endsection

@section('js')
	<script>
		//toastr["success"]("My name is Inigo Montoya. You killed my father. Prepare to die!");
		/*$('#load').click(function(event) {
			event.preventDefault();
		    var $btn = $(this);
		    var dataInit = $(this).text();
		    var dataLoad = $btn.data('loading-text');
		    $btn.html(dataLoad);
			setTimeout(function(){
                $btn.html(dataInit);
            }, 8000);
		});*/
	</script>
@endsection