<div class="top-bar-langs">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@if(isset($languages['other']))
					<ul class="text-center">
						@foreach($languages['other'] as $lang)
						<li>
							<a href="/{{ $lang->slug }}/{{collect(explode('/', Request::path()))->last()}}">
								<i class="icon-lang icon-{{$lang->slug}}"></i>&nbsp
							</a>
						</li>
						@endforeach
					</ul>
				@endif
			</div>
		</div>
	</div>
</div>