<h6>Urmărește-ne pe rețele de socializare</h6>

<ul class="social">
    @foreach($socials as $social)
        <li>
            <a href="{{ $social->link }}" class="icon-{{ $social->key }}"></a>
        </li>
    @endforeach
</ul><!-- Socials -->