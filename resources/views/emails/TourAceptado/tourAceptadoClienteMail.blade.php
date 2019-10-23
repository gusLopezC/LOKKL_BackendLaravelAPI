@component('mail::message')

#Hola {{$payment->getComprador[0]->name}}.

<h3>Tu reserva del tour <b>{{$payment->NameTour}}</b> para el dia {{$payment->Fechareserva}} .</h3>
<h3>A sido confirmada y los detalles están a continuación.</h3>

<table>
    <tr>
        <td>
            Nombre del Tour</td>
        <td> {{$payment->NameTour}}</td>
    </tr>
    <tr>
        <td>Proveedor de tours:</td>
        <td>{{$payment->getGuia[0]->name}}</td>
    </tr>
    <tr>
        <td>Fecha del tour</td>
        <td>{{$payment->Fechareserva}}</td>
    </tr>
    <tr>
        <td>Ocupantes:</td>
        <td>{{$payment->CantidadTuristas}}</td>
    </tr>
    <tr>
        <td>No. de referencia pedido:</td>
        <td>{{$payment->order_nr}}</td>
    </tr>
</table>
<br><br>
<h3>
    Gracias por reservar con lokkl.com. Esperamos que disfrutes tu  viaje. Hasta la próxima.
</h3>
<h3>Puedes comunicarte con nosotros y tu guia para resolver todas tus dudas !Buen viaje¡.</h3>

<h4>Inicie sesión en su cuenta personal para administrar fácilmente sus reservas y ponerse en contacto con su proveedor de tours.</h4>
@component('mail::button', ['url'=> 'https://lokkl.com/users/myTraverls'])
Login
@endcomponent
<br>
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
<small>Si no puede asistir al recorrido, infórmenos con anticipación. Puede cancelar hasta 48 hora antes de la hora de inicio programada del recorrido.</small>

@endcomponent