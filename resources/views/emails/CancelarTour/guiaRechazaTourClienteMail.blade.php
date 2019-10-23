@component('mail::message')

#Hola {{$payment->getComprador[0]->name}}.

<h3>Recientemente se ha cancelado su reserva de lokkl.com</h3>
<br>
<h3>Lamentablemente nuestro guía nos informa que le es imposible realizar el tour el día pactado.</h3>
<h3>Nos pondremos en contacto contigo para poder ofrecerte una alternativa o contactarte con otro de nuestros guias LOKKL.</h3>
<p>En caso de que tengas una duda puedes responder este correo con tu numero de pedido para poder resolver todas tus dudas. </p>

@component('mail::button', ['url'=> 'https://lokkl.com'])
Login
@endcomponent
<tr>
<td>En caso de aplicar rembolso este se vera reflejado en un plazo de 10 días hábiles dependiendo la institución bancaria.</td>
</tr>
<br>
Gracias<br>
El equipo de {{config('app.name')}}
<br><br>
@endcomponent