@component('mail::message')

#Hola {{$payment->getGuia[0]->name}}.

<h3>Se a realizado la cancelacion de tu reservación para el dia {{$payment->Fechareserva}}.</h3>
<h3>Nos contactaremos contigo y el turista para buscar reagendar para una fecha distinta</h3>
<p>Recuerda que cuentas con 24 horas a partir de la reserva para realizar la confirmacíon,demasiadas cancelaciónes puede ocasionar una mala califación por parte de los turistas.</p>
<br>


@component('mail::button', ['url'=> 'https://lokkl.com'])
Sigue recomendando tus tours
@endcomponent
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
@endcomponent