@if (count($errors) > 0)
  	@foreach($errors->get($field) as $error)
        <div>{!! $error !!}</div>
    @endforeach
@endif