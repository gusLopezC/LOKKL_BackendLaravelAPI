@component('mail::message')

<div class="header">
    <img src="https://www.lokkl.com/assets/img/becomeguide/passport.png" alt="" width="250px">
</div>

#Hello {{ $prospectos->name}}

<p>We are very happy that you want to be part of the LOKKL family, remember that for us it is very important the safety
    of our tourists as of our guides is why we ask you to upload your verification documents so you can create your
    experiences and start giving Your community and different destinations.<p>

        @component('mail::button', ['url'=> 'https://www.lokkl.com/#/users/validateIdentity'])
        Please upload yours documents
        @endcomponent

        <br><br>
        Thank,<br>
        The LOKKL team
        <br>
        @endcomponent