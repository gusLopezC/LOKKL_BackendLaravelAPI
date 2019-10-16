@component('mail::message')

<div class="header">
    <img src="https://lokkl.ml/images/Tiki.png" alt="" width="150px">
</div>

#Congratulations {{ $prospectos->name}}

<p>Estás un paso más cerca de ser una guía LOKKL y pertenecer a la mejor red de guías, ahora revisaremos tu información y te informaremos cuando hayas sido aceptado.<p>

        @component('mail::button', ['url'=> 'https://www.lokkl.com/#/home'])
        Create your experiences
        @endcomponent

        <br><br>
        Thank,<br>
        The LOKKL team
        <br>
        @endcomponent