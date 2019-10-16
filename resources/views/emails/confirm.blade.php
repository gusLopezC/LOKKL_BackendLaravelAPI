@component('mail::message')
#Hello {{ $user->name}}
<h1>Bienvenido a LOOK.</h1><br><br>

<p>
Gracias por unirte a LOKKL: <br>

Por favor verifíquelo usando el siguiente enlace:</p><br><br>

@component('mail::button', ['url'=> route('users.verify',$user->verification_token)]) 
Confirme su cuenta
@endcomponent

Gracias<br>
{{config('app.name')}}
@endcomponent