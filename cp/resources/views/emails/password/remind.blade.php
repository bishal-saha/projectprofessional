<p>You are receiving this email because we received a password reset request for your account.</p>

<p>Please click on this link below in order to reset your password:</p>

<a href="{{ url('password/reset/' . $token) }}">Reset Password</a> <br/><br/>

<p>If you’re having trouble clicking the ":button" button, copy and
    paste the URL below into your web browser:</p>

<p>{{ url('password/reset/' . $token) }}</p>

Many Thanks, <br/>
{{ settings('app_name') }}