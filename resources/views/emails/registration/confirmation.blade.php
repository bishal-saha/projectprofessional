<h1>{{ settings('app_name') }}</h1>
<p>Thank you for registering on :{{ settings('app_name') }} website.</p>

<p>Please confirm your email by clicking on the link below:</p>

<a href="{{ route('register.confirm-email', $token) }}">Confirm Email</a> <br/><br/>

<p>If you’re having trouble clicking the ":button" button, copy and paste the URL below into your web browser:</p>

<p>{{ route('register.confirm-email', $token) }}</p>

Many Thanks, <br/>
{{ settings('app_name') }}