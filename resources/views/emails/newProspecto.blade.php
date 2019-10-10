@component('mail::message')
#Un nuevo candidato a empezo su proceso de registro

<p>Este mensaje es recibido desde lokkl.com</p>

<div>

    
<p><b>Nombre:</b>&nbsp;{{$prospectos->name}}</p>
<p><b>Email:</b>&nbsp;{{$prospectos->emailContacto}}</p>
<p><b>Telefono:</b>&nbsp;{{$prospectos->telefono}}</p>
<p><b>Ciudad del tour:</b>&nbsp;{{$prospectos->ciudad}}</p>

</div>

Thank You,
<br/>
@endcomponent