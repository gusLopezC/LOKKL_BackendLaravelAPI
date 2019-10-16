@component('mail::message')
#Hola {{ $user->name}}
<h1>Bienvenido a LOKKL.</h1><br><br>


Gracias por unirte a LOKKL:<br>

Por favor verifíquelo usando el siguiente enlace:

@component('mail::button', ['url'=> route('users.verify',$user->verification_token)])
Confirme su cuenta
@endcomponent

Gracias<br>
{{config('app.name')}}
@endcomponent