@component('mail::message')

<div class="header">
    <img src="https://www.lokkl.com/assets/img/becomeguide/passport.png" alt="" width="250px">
</div>

#Hello {{ $prospectos->name}}

<p>Estamos muy contentos de que quieras formar parte de la familia LOKKL, recuerda que para nosotros es muy importante la seguridad
        de nuestros turistas como de nuestros guías, es por eso que le pedimos que cargue sus documentos de verificación para que pueda crear su
        experiencias y comienza a dar a tu comunidad y diferentes destinos.<p>

        @component('mail::button', ['url'=> 'https://www.lokkl.com/users/prospects/validateIdentity'])
        Por favor cargue sus documentos
        @endcomponent

        <br><br>
        Thank,<br>
        El equipo de LOKKL
        <br>
        @endcomponent