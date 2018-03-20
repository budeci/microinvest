@if(session()->has('status'))
    <span class="hidden" data-notification>{{ session()->get('status') }}</span>
@endif