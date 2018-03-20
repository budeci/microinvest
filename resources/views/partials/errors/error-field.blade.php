@if(count($errors))
    <ul>
        @foreach($errors->get($field) as $error)
            <li style="color: red">{!! $error !!}</li>
        @endforeach
    </ul>
@endif