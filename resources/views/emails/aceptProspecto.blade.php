@component('mail::message')

<div class="header">
    <img src="https://lokkl.ml/images/Tiki.png" alt="" width="150px">
</div>

#Hola {{ $prospectos->name}}

<p>Es un placer informarle que ha sido verificado como una guía LOKKL, ¡Lo más increíble de ser un LOKKL es que serás parte de una familia de guías que trabajarán y pondrán lo mejor de sus esfuerzos para que todos los viajeros que contraten un tour LOKKL piensen en nosotros para su próximo viaje!.<p>
        <br><br><br><br>
        @component('mail::button', ['url'=> 'https://www.lokkl.com/#/home'])
        Crea tu experiencia
        @endcomponent

        <br><br>
        Gracias,<br>
        The LOKKL team
        <br>
        @endcomponent