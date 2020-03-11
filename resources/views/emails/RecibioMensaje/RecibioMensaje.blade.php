@component('mail::message')
<h1>Tienes un nuevo mensaje</h1> 
<p></p>
<div>
    <table>
        <tr>
            <td style="text-align: center;">
                
                <img src="{{$receptor->img}}" alt="" style="    width: 50px;
                height: 50px;
                border-radius: 150px;
                position: absolute;
                top: 30%;
                left: 35%;"> </td>
            <td style="width: 90%;">
                <h3 style="padding: 5%;">"{{ $mensaje->mensaje}}"
                </h3>
            </td>
        </tr>   
    </table>
</div>
<br><br>
@component('mail::button', ['url'=> 'https://www.lokkl.com/#/home'])
Responder
@endcomponent

<br><br>
Thank,<br>
The LOKKL team
<br>
@endcomponent