@component('mail::message')

<div class="header">
    <img src="https://lokkl.ml/images/Tiki.png" alt="" width="150px">
</div>

#Congratulations {{ $prospectos->name}}

<p>You are one step closer to being a LOCAL guide and belonging to the best network of guides, now we will review your information and inform you when you have been accepted.<p>

        @component('mail::button', ['url'=> 'https://www.lokkl.com/#/home'])
        Create your experiences
        @endcomponent

        <br><br>
        Thank,<br>
        The LOKKL team
        <br>
        @endcomponent