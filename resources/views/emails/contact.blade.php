@component('mail::message')
#Hemos recibido un email

<p>Este mensaje es recibido desde lokkl.com</p>
<div>
<p><b>Remitente:</b>&nbsp;{{$demo->name}}</p>
<p><b>Email:</b>&nbsp;{{$demo->email}}</p>
<p><b>Mensaje:</b>&nbsp;{{$demo->textomensaje}}</p>
</div>

Thank You,
<br/>
@endcomponent