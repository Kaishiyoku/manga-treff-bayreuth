<p>
    {{ __('If you did not receive the email') }}, <a class="link" onclick="event.preventDefault(); document.getElementById('resend-verification-form').submit();">{{ __('click here to request another') }}</a>.
</p>

<form id="resend-verification-form" method="POST" action="{{ route('verification.resend') }}" class="hidden">
    @csrf
</form>
