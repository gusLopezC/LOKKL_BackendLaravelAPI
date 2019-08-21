@component('mail::message')
#Hello {{ $user->name}}
<h1>Welcome to LOOK.</h1><br><br>

<p>
Thank you for joining LOKKL: <br>

Please verify it using the following link:</p><br><br>

@component('mail::button', ['url'=> route('users.verify',$user->verification_token)]) 
    Confirm your account
@endcomponent

Thank you<br>
{{config('app.name')}}
@endcomponent