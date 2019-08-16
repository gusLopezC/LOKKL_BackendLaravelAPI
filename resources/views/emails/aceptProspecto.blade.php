@component('mail::message')

<div class="header">
    <img src="https://lokkl.ml/images/Tiki.png" alt="" width="150px">
</div>

#Hello {{ $prospectos->name}}

<p>It is a pleasure to inform you that it has been verified as a LOKKL guide, beginning with the LOKKL family.<p>

        @component('mail::button', ['url'=> 'https://www.lokkl.com/#/home'])
        Create your experiences
        @endcomponent

        <br><br>
        Thank,<br>
        The LOKKL team
        <br>
        @endcomponent