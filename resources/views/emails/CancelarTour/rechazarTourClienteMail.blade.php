@component('mail::message')

#Hola {{$payment->getComprador[0]->name}}.

<h3>Recientemente se ha cancelado su reserva de lokkl.com mediante el enlace de cancelación.</h3>
<h3>Si no fue su intención de cancelar la reserva, por favor háganoslo saber de inmediato respondiendo a este correo donde incluya su número de confirmación de reserva.</h3>
<br>
<h3>¿Sus planes han cambiado o tu fechas de viaje cambio? Puedes comunicarte con nosotros para obtener las mejores opciones.</h3>
<br>
@component('mail::button', ['url'=> 'https://lokkl.com'])
Login
@endcomponent
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
@endcomponent