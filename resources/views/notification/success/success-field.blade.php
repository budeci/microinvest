@if(count($success))
    <ul>
        @foreach($success->get($field) as $item)
            <li style="color: green">{!! $item !!}</li>
        @endforeach
    </ul>
@endif