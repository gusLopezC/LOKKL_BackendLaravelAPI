@component('mail::message')

#Hola {{$payment->getGuia[0]->name}}.

<h3>Recientemente se ha cancelado su reservación por parte del cliente.</h3>

<h3>Estaremos en contacto con el turista para buscar una alternativa o reagendar para otra fecha. </h3>

<br>
@component('mail::button', ['url'=> 'https://lokkl.com'])
Sigue recomendando tus tours
@endcomponent
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
@endcomponent