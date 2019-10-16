@component('mail::message')

#Hola {{$payment->getComprador[0]->name}}.

<h3>Tu reserva del tour <b>{{$payment->NameTour}}</b> se realizó con exito para {{$payment->Fechareserva}} .</h3>
<h3>Tu LOKKL dispone de 24 horas a partir de ahora para responderte.Te informaremos cuando
    el guia confirme tu solicitud.
</h3>
<h3>
    Es posible que veas la autorizacíon de un cobro por $ {{ $payment->Monto}} {{ $payment->Moneda}}, pero este no sera realizado hasta la confirmación de tu reserva.
</h3>
<h3>Puedes comunicarte con tu guia para resolver todas tus dudas !Buen viaje¡.</h3>


Gracias<br>
El equipo de {{config('app.name')}}

@endcomponent