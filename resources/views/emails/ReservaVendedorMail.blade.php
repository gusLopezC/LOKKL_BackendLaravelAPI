@component('mail::message')

#Hola {{$payment->getGuia[0]->name}}.

<h2>Haz recibido una reserva por tu tour <b>{{$payment->NameTour}}</b> para el dia {{$payment->Fechareserva}} .</h2>
<h2>Te recordamos que dispones de 24 horas a partir de ahora para responder y confirmar el tour,recibieramos el pago del tour 24 horas despues de la finalizacíon de este.
</h2>
<br>
<h2>Puedes comunicarte con tu guia para resolver todas tus dudas !Buen viaje¡.</h2>


Gracias<br>
{{config('app.name')}}
@endcomponent