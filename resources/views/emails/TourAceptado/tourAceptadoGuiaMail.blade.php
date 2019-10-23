@component('mail::message')

#Hola {{$payment->getGuia[0]->name}}.

<h3>Tu reserva del tour <b>{{$payment->NameTour}}</b> para el dia {{$payment->Fechareserva}} esta preparada.</h3>

<table>
    <tr>
        <td>
            Nombre del Tour</td>
        <td> {{$payment->NameTour}}</td>
    </tr>
    <tr>
        <td>Tu cliente:</td>
        <td>{{$payment->getComprador[0]->name}}</td>
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


<h4>Inicie sesión en su cuenta personal para administrar fácilmente sus reservas y gestionarlas.</h4>
@component('mail::button', ['url'=> 'https://lokkl.com/users/myreservations'])
Login
@endcomponent
<br>
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
<small>Si no puede asistir al recorrido, infórmenos con anticipación. Puede cancelar hasta 48 hora antes de la hora de inicio programada del recorrido.</small>

@endcomponent